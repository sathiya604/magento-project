<?php
namespace TrendsAttribute\AdminSales\Model;

class Item extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_adminsales_item';
    protected $_cacheTag = 'trendsattribute_adminsales_item';
    protected $_eventPrefix = 'trendsattribute_adminsales_item';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\AdminSales\Model\ResourceModel\Item');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
