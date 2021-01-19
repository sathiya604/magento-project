<?php
namespace TrendsAttribute\ProductAttribute\Observer;

use Magento\Framework\Event\ObserverInterface;

class SetItemClothingMaterial implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quoteItem = $observer->getQuoteItem();
        $product = $observer->getProduct();
        $quoteItem->SetClothingMaterial($product->getAttributeText('clothing_material'));
    }
}
