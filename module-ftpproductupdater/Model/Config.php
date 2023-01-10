<?php

/**
 * Copyright © Lumav Commerce. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class Config
{
    const XML_PATH_DECCO_CONFIG_USERNAME = 'lumav_decco/general/username';
    const XML_PATH_DECCO_CONFIG_PASSWORD = 'lumav_decco/general/password';
    const XML_PATH_DECCO_CONFIG_URL = 'lumav_decco/general/url';
    const XML_PATH_DECCO_CONFIG_WAREHOUSECODE = 'lumav_decco/general/warehousecode';
    const XML_PATH_DECCO_CONFIG_IMPORT_ENABLED = 'lumav_decco/configuration/import';
    const XML_PATH_DECCO_DEBUG_LOG = 'lumav_decco/debug/log';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var WriterInterface
     */
    protected $configWriter;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param WriterInterface $configWriter
     */
    
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
    }

    /**
     * Gets config value
     *
     * @param string $path
     * @param null $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getConfig(string $path, $scopeType = null, $scopeCode = null)
    {
        if ($scopeType === null) {
            $scopeType = ScopeInterface::SCOPE_STORE;
        }

        return $this->scopeConfig->getValue($path, $scopeType, $scopeCode);
    }

    /**
     * Set config value
     *
     * @param string $path
     * @return mixed
     */
    public function setConfig($path, $value)
    {
        return $this->configWriter->save($path, $value, ScopeConfigInterface::SCOPE_TYPE_DEFAULT, 0);
    }

    public function isDebugEnabled($scopeType = null, $scopeCode = null)
    {
        return $this->getConfig(self::XML_PATH_DECCO_DEBUG_LOG, $scopeType, $scopeCode);
    }
}
