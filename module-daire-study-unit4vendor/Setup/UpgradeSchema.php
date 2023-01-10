<?php

namespace Lumav\DaireStudyUnit4vendor\Setup;


use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.3', '<')) {
            $tableName = 'training4_vendor2product';
            $table = $setup->getConnection()->newTable($setup->getTable($tableName));
            $table->addColumn('vendor2product_id', Table::TYPE_INTEGER, null, [
            'primary' => true,
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            ]);
            $table->addColumn('vendor_id', Table::TYPE_INTEGER, null, [
                'unsigned' => true, 
                'nullable' => false, 
                'primary' => true, 
                'default' => '0'
            ]);

            $table->addColumn('product_id', Table::TYPE_INTEGER, null, [
                'unsigned' => true, 
                'nullable' => false, 
                'primary' => true, 
                'default' => '0'
            ]);

            $table->addIndex(
                $setup->getIdxName('training4_vendor2product', ['product_id']),
                ['product_id']
            );
            $table->addIndex(
                $setup->getIdxName('training4_vendor2product',
                    ['vendor_id', 'product_id'],
                    AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['vendor_id', 'product_id'],
                ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
            );
            $table->addForeignKey(
                $setup->getFkName(
                    'training4_vendor2product', 'product_id', 'catalog_product_entity', 'entity_id'),
                'product_id',
                $setup->getTable('catalog_product_entity'),
                'entity_id',
                Table::ACTION_CASCADE
                );
            $table->addForeignKey(
                $setup->getFkName(
                    'training4_vendor2product', 'vendor_id', 'training4_vendor2product', 'vendor2product_id'),
                'vendor_id',
                $setup->getTable('training4_vendor2product'),
                'vendor2product_id',
                Table::ACTION_CASCADE
                );

            $setup->getConnection()->createTable($table);

        }
        $setup->endSetup();
    }
}
            