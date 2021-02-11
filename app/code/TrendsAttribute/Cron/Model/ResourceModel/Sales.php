<?php
namespace TrendsAttribute\Cron\Model\ResourceModel;

class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('custom_sales_order_grid', 'item_id');
    }
}
