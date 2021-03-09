<?php
namespace Task\FlashSale\Model\ResourceModel;

class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'flash_sale_id';
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('flash_sale', 'flash_sale_id');
    }
}
