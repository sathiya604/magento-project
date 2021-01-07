<?php
namespace TrendsAttribute\EventObserver\Observer\Product;

class Cart implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $sku = $item->getProduct()->getData('sku');
        if ($sku == "T-Shirt") {
            $customQty = 2;
            $item->setQty($customQty);
            $item->setOriginalQty($customQty);
            $price = $item->getPrice();
            $customPrice = $price/2;
            $item->setCustomPrice($customPrice);
            $item->setOriginalCustomPrice($customPrice);
            $item->getProduct()->setIsSuperMode(true);
        }
    }
}
