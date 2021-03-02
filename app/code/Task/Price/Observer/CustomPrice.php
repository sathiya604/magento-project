<?php
namespace Task\Price\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    protected $customerGroup;
    protected $sku;
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_customerSession = $customerSession;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $sku = ['Rolex 1001', 'Boat Storm', 'Lehanga', 'Red Tops', 'Alice in wonderland-1'];
        $product = $observer->getEvent()->getProduct();
        $pId = $product->getId();
        $qty = $observer->getEvent()->getQty();
        $storeId = $product->getStoreId();
        if ($this->_customerSession->isLoggedIn()) {
            $this->customerGroup = $this->_customerSession->getCustomer()->getGroupId();
        }
        $this->logger->info($observer->getEvent()->getOrder());
        if ($this->customerGroup == 1) {
            if (in_array($product->getSku(), $sku)) {
                $finalPrice = $product->getData('final_price') - $product->getData('final_price')*0.1;
            } else {
                $finalPrice = $product->getData('final_price');
            }

            $finalPrice = min($product->getData('final_price'), $finalPrice);
            $product->setFinalPrice($finalPrice);

            return $this;
        } else {
            return $this;
        }
    }
}
