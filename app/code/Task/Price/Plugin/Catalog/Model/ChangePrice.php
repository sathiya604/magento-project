<?php
namespace Task\Price\Plugin\Catalog\Model;

use Magento\Catalog\Pricing\Price\BasePrice;

class ChangePrice
{
    protected $sku;
    protected $discount;
    protected $customerGroup;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        $this->_customerSession = $customerSession;
        $this->logger = $logger;
        $this->product = $productRepository;
    }

    public function afterGetValue(BasePrice $subject, $result)
    {
        $discount = $result*10/100;
        $sku = ['Rolex 1001', 'Boat Storm', 'Lehanga', 'Red Tops', 'Alice in wonderland-1'];
        if ($this->_customerSession->isLoggedIn()) {
            $this->customerGroup = $this->_customerSession->getCustomer()->getGroupId();
        }
        if ($this->customerGroup == 1) {
            if (in_array($subject->getData('sku'), $sku)) {
                return $result-$discount;
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    }
}
