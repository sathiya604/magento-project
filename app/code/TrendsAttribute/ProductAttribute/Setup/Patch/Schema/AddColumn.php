<?php
/**
* to add column
*/
namespace TrendsAttribute\ProductAttribute\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;

class AddColumn implements SchemaPatchInterface
{
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->moduleDataSetup->getConnection()->addColumn(
            $this->moduleDataSetup->getTable('review'),
            'customer_name',
            [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'Name',
           ]
        );

        $this->moduleDataSetup->endSetup();
    }
}
