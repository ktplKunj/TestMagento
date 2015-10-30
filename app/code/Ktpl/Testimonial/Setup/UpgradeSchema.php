<?php

namespace Ktpl\Testimonial\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1') < 0) {

            $installer = $setup;
            $installer->startSetup();

            $installer->getConnection()->addColumn(
                $installer->getTable('testimonial'),
                'email',
                array(
                    'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
                    'nullable' => true,
                    'length' => '1k',
                    'comment' => 'Email Field'
                )
            );

            $installer->endSetup();
        }
         if (version_compare($context->getVersion(), '1.0.2') < 0) {

            $installer = $setup;
            $installer->startSetup();

            $installer->getConnection()->addColumn(
                $installer->getTable('testimonial'),
                'customer_image',
                array(
                    'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
                    'nullable' => true,
                    'length' => '1k',
                    'comment' => 'Customer Image'
                )
            );
             $installer->getConnection()->addColumn(
                $installer->getTable('testimonial'),
                'store_id',
                array(
                    'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,            'nullable' => true,
                    'comment' => 'Store Id'
                )
            );

            $installer->endSetup();
        }
    }
}
