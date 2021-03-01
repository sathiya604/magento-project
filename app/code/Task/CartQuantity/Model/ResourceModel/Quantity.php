<?php
namespace Task\CartQuantity\Model\ResourceModel;

class Quantity extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('cart_allowed_qty', 'id');
    }
}
