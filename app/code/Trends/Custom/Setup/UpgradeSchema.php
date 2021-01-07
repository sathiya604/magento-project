<?php
namespace Trends\Custom\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.4.0', '<')) {
            $installer->getConnection()->dropColumn($installer->getTable('mageplaza_helloworld_post'), 'tags');
        }

        if (version_compare($context->getVersion(), '1.5.0', '<')) {
            if ($installer->getConnection()->isTableExists('mageplaza_helloworld_post') == "true") {
                $installer->getConnection()->addColumn(
                    $installer->getTable('mageplaza_helloworld_post'),
                    'tags',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'nullable' => true,
                        'comment' => 'Post Tags'
                    ]
                );
            }
        }
        $installer->endSetup();
    }
}
