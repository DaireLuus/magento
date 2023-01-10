<?php

namespace Lumav\DaireStudyUnit4vendor\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('training4_vendor');
       

        $data = [
            ['name' => 'V Vendor '],
            ['name' => 'P Vendor '],
            ['name' => 'B Vendor '],
            ['name' => 'K Vendor '],
            ['name' => 'U Vendor '],
            ['name' => 'E Vendor '],
            ['name' => 'F Vendor '],
            ['name' => 'A Vendor '],
            ['name' => 'L Vendor ']
            ];
        
        foreach ($data as $item) {
            $setup->getConnection()->insert($tableName, $item);
        }


        $setup->endSetup();
    }
}