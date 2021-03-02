<?php
namespace TrendsAttribute\CustomSales\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_customsales_feedback';

    protected $_cacheTag = 'trendsattribute_customsales_feedback';

    protected $_eventPrefix = 'trendsattribute_customsales_feedback';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\CustomSales\Model\ResourceModel\Post');
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
