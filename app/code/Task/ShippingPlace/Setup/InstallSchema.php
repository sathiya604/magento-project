<?php

namespace Task\ShippingPlace\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $connection = $installer->getConnection();
        $connection
            ->addColumn(
                $installer->getTable('quote_address'),
                'ship_to',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'nullable' => true,
                    'default' => null,
                    'length' => 255,
                    'comment' => 'Shipping Place',
                    'after' => 'fax'
                ]
            );
        $connection
            ->addColumn(
                $installer->getTable('sales_order_address'),
                'ship_to',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'nullable' => true,
                    'default' => null,
                    'length' => 255,
                    'comment' => 'Shipping Place',
                    'after' => 'fax'
                ]
            );

        $installer->endSetup();
    }
}
