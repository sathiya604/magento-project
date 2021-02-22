<?php
namespace Task\Price\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ChangePrice
{
    protected $sku;
    protected $customerGroup;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_customerSession = $customerSession;
        $this->logger = $logger;
    }


    public function afterGetPrice(Product $subject, $result)
    {
        $sku = ['Rolex 1001', 'Boat Storm', 'Lehanga', 'Red Tops', 'Alice in wonderland-1'];
        if ($this->_customerSession->isLoggedIn()) {
           $this->customerGroup = $this->_customerSession->getCustomer()->getGroupId();  
        }
        $this->logger->info($this->customerGroup);
        if ($this->customerGroup == 1) {
            if (in_array($subject->getData('sku'), $sku)) {
               $discount = $subject->getData('price')*10/100;

            return $subject->getData('price')-$discount;
            } else {
           
           return $result;
        }
        } else {
           
           return $result;
        }
    }
}
