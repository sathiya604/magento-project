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
        $product = $this->getCurrentProduct();
        $stock = $this->stockRegistry->getStockItem($product->getId());
        if ($stock->getQty() != 0) {
            return $stock->getQty();
        } else {
            return "few";
        }
    }

    /**
    * @return \Magento\Catalog\Model\Product
    */
    public function getCurrentProduct()
    {
        return $this->registry->registry('product');
    }
}
