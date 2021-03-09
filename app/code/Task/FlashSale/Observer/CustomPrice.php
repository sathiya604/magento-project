<?php
namespace Task\FlashSale\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    protected $customerGroup;
    protected $sku;
    protected $salesCollectionFactory;
    protected $flashSaleCollectionFactory;
    protected $itemCollectionFactory;
    protected $logger;
    protected $dateTime;

    public function __construct(
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $flashSaleCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory $itemCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $dateTime
    ) {
        $this->logger = $logger;
        $this->salesCollectionFactory = $salesCollectionFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->flashSaleCollectionFactory = $flashSaleCollectionFactory;
        $this->dateTime = $dateTime;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->info($this->dateTime->date()->format('Y-m-d H:i:s'));
        $collection = $this->salesCollectionFactory->create()
                          ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('is_active', ['eq' => 1]);
        foreach ($collection as $value) {
            $activeFlashSale = $value['flash_sale_id'];
            $discountPercent = $value['discount_percent'];
            $maxDiscount = $value['max_discount_amount'];
            $this->logger->info($value['flash_sale_id']);
        }
        if (!empty($activeFlashSale) && isset($activeFlashSale)) {
            $product = $observer->getEvent()->getProduct();
            $pId = $product->getId();
            $qty = $observer->getEvent()->getQty();
            $storeId = $product->getStoreId();
            $sku = $product->getSku();
            $this->logger->info("qty order");
            $this->logger->info($qty);
            $itemCollection = $this->itemCollectionFactory->create()
                              ->addFieldToFilter('flash_sale_id', ['eq' => $activeFlashSale])
                              ->addFieldToFilter('sku', ['eq' => $sku]);
            foreach ($itemCollection as $value) {
                $flashSaleItemId = $value['flash_sale_item_id'];
                $qtyLeft = $value['qty_left'];
                $orderSku = $value['sku'];
                $this->logger->info($value['sku']);
                $this->logger->info($value['qty_left']);
            }

            if (!empty($orderSku) && isset($orderSku) && $sku == $orderSku && $qty <= $qtyLeft) {
                $discount = $product->getData('final_price')*$discountPercent/100;
                if ($maxDiscount != 0) {
                    if ($maxDiscount < $discount) {
                        $finalPrice = $product->getData('final_price') - $maxDiscount;
                    }
                } else {
                    $finalPrice = $product->getData('final_price') - $discount;
                }
                $finalPrice = min($product->getData('final_price'), $finalPrice);
                $product->setFinalPrice($finalPrice);

                return $this;
            } else {
                return $this;
            }
        } else {
            return $this;
        }
    }
}
