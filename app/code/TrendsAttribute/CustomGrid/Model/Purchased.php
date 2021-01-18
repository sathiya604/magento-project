<?php
namespace TrendsAttribute\CustomGrid\Model;

class Purchased extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('TrendsAttribute\CustomGrid\Model\ResourceModel\Purchased');
    }
}
