<?php
/**
 * Source file for attribute
 */

namespace TrendsAttribute\ProductAttribute\Model\Attribute\Source;

class Material extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Cotton'), 'value' => 'Cotton'],
                ['label' => __('Leather'), 'value' => 'Leather'],
                ['label' => __('Silk'), 'value' => 'Silk'],
                ['label' => __('Denim'), 'value' => 'Denim'],
                ['label' => __('Fur'), 'value' => 'Fur'],
                ['label' => __('Wool'), 'value' => 'Wool'],
            ];
        }
        return $this->_options;
    }
}
