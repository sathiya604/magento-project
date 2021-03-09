<?php
namespace Task\FlashSale\Model;

class Sales extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'task_flashsale_sales';
    protected $_cacheTag = 'task_flashsale_sales';
    protected $_eventPrefix = 'task_flashsale_sales';

    protected function _construct()
    {
        $this->_init('Task\FlashSale\Model\ResourceModel\Sales');
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
