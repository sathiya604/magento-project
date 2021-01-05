<?php

namespace Trends\Custom\Block;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class StockLeft extends Template
{
    private $registry;
    private $stockRegistry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        StockRegistryInterface $stockRegistry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->stockRegistry = $stockRegistry;
    }

    /**
    * @return int
    */
    public function getRemainingQuantity()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $StockState = $objectManager->get('\Magento\CatalogInventory\Api\StockStateInterface');
        $product = $this->getCurrentProduct();
        $stock = $this->stockRegistry->getStockItem($product->getId());
        if ($product->getTypeId() == "configurable") {
            $total_stock = 0;
            $productTypeInstance = $product->getTypeInstance();
            $usedProducts = $productTypeInstance->getUsedProducts($product);

            foreach ($usedProducts as $simple) {
                $total_stock += $StockState->getStockQty($simple->getId(), $simple->getStore()->getWebsiteId());
            }

            return $total_stock;
        }

        if ($stock->getQty() != 0) {
            return $stock->getQty();
        }
        return "few";
    }

    /**
    * @return \Magento\Catalog\Model\Product
    */
    public function getCurrentProduct()
    {
        return $this->registry->registry('product');
    }
}
