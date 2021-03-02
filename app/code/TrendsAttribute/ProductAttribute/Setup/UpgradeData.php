<?php
namespace TrendsAttribute\ProductAttribute\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;
    private $quoteSetupFactory;
    private $salesSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        QuoteSetupFactory $quoteSetupFactory,
        SalesSetupFactory $salesSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.5.0', '<')) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $quoteSetup = $this->quoteSetupFactory->create(['setup' => $setup]);
            $salesSetup = $this->salesSetupFactory->create(['setup' => $setup]);
            $attributeOptions = [
            'type'     => Table::TYPE_TEXT,
            'visible'  => true,
            'required' => false
            ];
            $quoteSetup->addAttribute('quote_item', 'clothing_material', $attributeOptions);
            $salesSetup->addAttribute('order_item', 'clothing_material', $attributeOptions);
        }
    }
}
