<?php

namespace Ktpl\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        if (!$installer->tableExists('slider')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('slider')
            )->addColumn(
                    'slider_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true],
                    'slider ID'
                )->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Title'
                )->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => false],
                    'Post'
                )->addColumn(
                    'publish_date',
                    Table::TYPE_DATE,
                    null,
                    [],
                    'Publish Date'
                )->addColumn(
                    'is_active',
                    Table::TYPE_SMALLINT,
                    null,
                    [],
                    'Active Status'
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Creation Time'
                )->addColumn(
                    'update_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Modification Time'
                )->setComment(
                    'Slider Table'
                );
            $installer->getConnection()->createTable($table);

        }
        $installer->endSetup();

    }
}