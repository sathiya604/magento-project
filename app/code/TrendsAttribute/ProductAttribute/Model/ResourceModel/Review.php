<?php
namespace TrendsAttribute\ProductAttribute\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Review extends AbstractDb
{
    public function _construct()
    {
        $this->_init("review", "review_id");
    }
}
