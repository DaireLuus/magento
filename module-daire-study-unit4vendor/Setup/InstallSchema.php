<?php

namespace Lumav\DaireStudyUnit4vendor\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;


class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = 'training4_vendor';
        $table = $setup->getConnection()->newTable($setup->getTable($tableName));
        $table->addColumn('vendor_id', Table::TYPE_INTEGER, null, [
            'primary' => true,
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
        ]);
        $table->addColumn('name', Table::TYPE_TEXT, null, []);
        
        $setup->getConnection()->createTable($table);


        

        
        $setup->endSetup();
    }
}