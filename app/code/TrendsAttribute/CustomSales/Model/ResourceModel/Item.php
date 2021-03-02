<?php
namespace TrendsAttribute\CustomSales\Model\ResourceModel;

class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'item_id';
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('sales_order_item', 'item_id');
    }
}
