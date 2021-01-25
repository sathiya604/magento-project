<?php
namespace TrendsAttribute\AdminSales\Model\ResourceModel;

class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'entity_id';
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('sales_order', 'entity_id');
    }
}
