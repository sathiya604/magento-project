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
        if ($this->_customerSession->isLoggedIn()) {
            $this->customerGroup = $this->_customerSession->getCustomer()->getGroupId();
        }

        $this->logger->info($this->customerGroup);
        if ($this->customerGroup == 1) {
            $item = $observer->getEvent()->getData('quote_item');
            $item = ($item->getParentItem() ? $item->getParentItem() : $item);
            if (in_array($item->getSku(), $sku)) {
                $price = $item->getPrice() - $item->getPrice()*0.1; //set your price here
                $item->setCustomPrice($price);
                $item->setOriginalCustomPrice($price);
                $item->getProduct()->setIsSuperMode(true);
            }
        }
    }
}
