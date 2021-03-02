<?php
namespace TrendsAttribute\ProductAttribute\Model;

use Magento\Framework\Model\AbstractModel;

class Review extends AbstractModel
{
    protected function _construct()
    {
        $this->_init("TrendsAttribute\ProductAttribute\Model\ResourceModel\Review");
    }
}
