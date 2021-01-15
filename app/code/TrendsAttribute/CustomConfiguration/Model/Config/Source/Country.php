<?php

namespace TrendsAttribute\CustomConfiguration\Model\Config\Source;

class Country implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'India' => 'India',
            'USA' => 'United States of America',
            'UK' => 'United Kingdom',
        ];
    }
}
