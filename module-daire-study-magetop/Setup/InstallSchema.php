<?php
 
namespace Lumav\DaireStudyMagetop\Setup;
 
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
 
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = 'magetop_blog';
        $table = $setup->getConnection()->newTable($setup->getTable($tableName));
        $table->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
            ],
            'ID'
        );
        $table->addColumn(
            'title',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Title'
        );
        $table->addColumn(
            'description',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Description'
        );
        $table->addColumn(
            'created_at',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Created At'
        );
        $table->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '0'],
            'Status'
        );
                
        $setup->getConnection()->createTable($table);
        
        $setup->endSetup();
    }
}