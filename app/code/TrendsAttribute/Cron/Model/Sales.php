<?php
namespace TrendsAttribute\Cron\Model;

class Sales extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_cron_cron';
    protected $_cacheTag = 'trendsattribute_cron_cron';
    protected $_eventPrefix = 'trendsattribute_cron_cron';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\Cron\Model\ResourceModel\Sales');
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
