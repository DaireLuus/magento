<?php

/**
 * Copyright © Lumav. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Cron;

use Magento\Framework\Xml\Parser;
use Magento\Framework\App\ResourceConnection;
use Lumav\Home4YouFtpProductUpdater\Model\Config;
use Lumav\Home4YouFtpProductUpdater\Logger\Logger;

class ProductUpdater
{
    /**
     * @var Parser
     * */
    protected $parser;

    /**
     * @var ResourceConnection
     * */
    protected $resource;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var int
     * */
    protected $warehouseId;

    /**
     * @var array
     * */
    protected $existingSkus;

    public function __construct(
        Parser $parser,
        ResourceConnection $resource,
        Config $config,
        Logger $logger
    ) {
        $this->parser = $parser;
        $this->resource = $resource;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Update product stock from remote location
     * @return ProductUpdater
     */
    public function execute(): ProductUpdater
    {
        $importEnabled = $this->config->getConfig(Config::XML_PATH_DECCO_CONFIG_IMPORT_ENABLED);
        $this->logger->debug(sprintf('Import status: %s', $importEnabled));
        if (!$importEnabled) {
            return $this;
        }

        $username = $this->config->getConfig(Config::XML_PATH_DECCO_CONFIG_USERNAME);
        $password = $this->config->getConfig(Config::XML_PATH_DECCO_CONFIG_PASSWORD);
        $url = $this->config->getConfig(Config::XML_PATH_DECCO_CONFIG_URL);

        if (!$username || !$password || !$url) {
            $this->logger->error('Username, password or XML url has not been configured!');
            return $this;
        }

        $context = stream_context_create([
            'http' => [
                'header' => 'Authorization: Basic ' . base64_encode($username . ':' . $password),
                'protocol_version' => 1.1
            ]
        ]);

        $startTime = time();
        try {
            $products = $this->parser->loadXML(file_get_contents($url, false, $context))->xmlToArray();
            $this->logger->info(sprintf('Import start: %s', 'orders'));
            foreach ($products['buum']['inventory']['item'] ?? [] as $product) {
                $this->insertOnDuplicate($product);
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->logger->error($e->getTraceAsString());
        }

        $this->logger->info(sprintf('Total importing time: %s, type: %s', (time() - $startTime), 'products'));
        return $this;
    }

    /**
     * Get warehouse id by warehouse code
     * @return int
     */
    public function getWarehouseIdByCode($forceReload = false): int
    {
        if ($forceReload || !isset($this->warehouseId)) {
            $conn = $this->resource->getConnection();
            $code = $this->config->getConfig(Config::XML_PATH_DECCO_CONFIG_WAREHOUSECODE);
            $select = $conn->select('entity_id')
                ->from(
                    ['w' => 'devall_buum_warehouse']
                )
                ->where('w.code=?', $code);
            $this->warehouseId = $conn->fetchOne($select);
        }

        return $this->warehouseId;
    }

    /**
     * Get existing product sku and product id pairs
     * @return array
     */
    public function getExistingSkus($forceReload = false): array
    {
        if ($forceReload || !isset($this->existingSkus)) {
            $connection = $this->resource->getConnection();
            $productTableName = $connection->getTableName('catalog_product_entity');

            $sql = $connection->select()->from(['cpe' => $productTableName], ['sku', 'entity_id'])
                ->columns([
                    'cpe.sku',
                    'cpe.entity_id'
                ]);

            $this->existingSkus = $connection->fetchPairs($sql);
        }

        return $this->existingSkus;
    }

    /**
     * Update product stock for existing skus
     * @return void
     */
    public function insertOnDuplicate($product): void
    {
        $conn = $this->resource->getConnection();
        $tableName = $conn->getTableName('devall_buum_warehouse_stock');
        $warehouseId = $this->getWarehouseIdByCode();
        $productSkusToIds = $this->getExistingSkus();

        if (isset($productSkusToIds[$product['code']])) {
            $data = [
                'warehouse_id' => $warehouseId,
                'product_id' => $productSkusToIds[$product['code']],
                'qty' => $product['volume']
            ];

            $conn->insertOnDuplicate($tableName, $data, ['qty']);
        }
    }
}
