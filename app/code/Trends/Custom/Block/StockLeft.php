<?php
namespace Trends\Custom\Block;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class StockLeft extends Template
{
    private $registry;
    private $stockRegistry;
    private $stockState;
    const FEW = 'few';

    public function __construct(
        Template\Context $context,
        Registry $registry,
        StockRegistryInterface $stockRegistry,
        StockStateInterface $stockState,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->stockRegistry = $stockRegistry;
        $this->stockState = $stockState;
    }

    /**
    * @return int
    */
    public function getRemainingQuantity()
    {
        $product = $this->getCurrentProduct();
        $stock = $this->stockRegistry->getStockItem($product->getId());
        if ($product->getTypeId() == "configurable") {
            $totalStock = 0;
            $productTypeInstance = $product->getTypeInstance();
            $usedProducts = $productTypeInstance->getUsedProducts($product);

            foreach ($usedProducts as $simple) {
                $totalStock += $this->stockState->getStockQty($simple->getId(), $simple->getStore()->getWebsiteId());
            }

            return $totalStock;
        }

        if ($stock->getQty() != 0) {
            return $stock->getQty();
        }
        return self::FEW;
    }

    /**
    * @return \Magento\Catalog\Model\Product
    */
    public function getCurrentProduct()
    {
        return $this->registry->registry('product');
    }
}
