<?php

/**
 * Copyright © Lumav. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class Decco implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $tableName = $this->moduleDataSetup->getTable('devall_buum_warehouse');
        if ($this->moduleDataSetup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                'code' => 9999,
                'name' => 'DECCO'
            ];

            $this->moduleDataSetup->getConnection()->insert($tableName, $data);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $tableName = $this->moduleDataSetup->getTable('devall_buum_warehouse');
        if ($this->moduleDataSetup->getConnection()->isTableExists($tableName) == true) {
            $this->moduleDataSetup->getConnection()->delete($tableName, ['code = ?' => 9999]);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
