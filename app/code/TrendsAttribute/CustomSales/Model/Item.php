<?php
namespace TrendsAttribute\CustomSales\Model;

class Item extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_customsales_item';

    protected $_cacheTag = 'trendsattribute_customsales_item';

    protected $_eventPrefix = 'trendsattribute_customsales_item';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\CustomSales\Model\ResourceModel\Item');
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
