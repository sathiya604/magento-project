<?php
namespace Task\ShippingPlace\Model\Source;

/**
 * Source file for attribute
 */
class Ship extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Select Place'), 'value' => ''],
                ['label' => __('Home'), 'value' => 'Home'],
                ['label' => __('Work'), 'value' => 'Work'],
            ];
        }

        return $this->_options;
    }
}
