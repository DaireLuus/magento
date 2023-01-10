<?php

namespace Lumav\DaireStudyUnit4vendor\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.3', '<')) {
            $setup->startSetup();

       
            $tableName = $setup->getTable('training4_vendor2product');

        
            $data = [
                ['vendor_id' => 1,'product_id' => 1191],
                ['vendor_id' => 2,'product_id' => 1191],
                ['vendor_id' => 3,'product_id' => 1191],
                ['vendor_id' => 4,'product_id' => 1190],
                ['vendor_id' => 5,'product_id' => 1191],
                ['vendor_id' => 6,'product_id' => 120],
                ['vendor_id' => 7,'product_id' => 119],
                ['vendor_id' => 8,'product_id' => 2],
                ['vendor_id' => 9,'product_id' => 1191],
                ['vendor_id' => 1,'product_id' => 2],
                ['vendor_id' => 2,'product_id' => 91],
                ['vendor_id' => 3,'product_id' => 2],
                ['vendor_id' => 4,'product_id' => 11],
                ['vendor_id' => 5,'product_id' => 120],
                ['vendor_id' => 1,'product_id' => 12],
                ['vendor_id' => 2,'product_id' => 1190],
                ['vendor_id' => 3,'product_id' => 11],
                ['vendor_id' => 1,'product_id' => 500],
                ['vendor_id' => 2,'product_id' => 600],
                ['vendor_id' => 8,'product_id' => 250],
                ['vendor_id' => 8,'product_id' => 1191]
                ];
                
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
            $setup->endSetup();
    }
}