<?php
namespace TrendsAttribute\Cron\Model;

class Order extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_cron_order';
    protected $_cacheTag = 'trendsattribute_cron_order';
    protected $_eventPrefix = 'trendsattribute_cron_order';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\Cron\Model\ResourceModel\Order');
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
