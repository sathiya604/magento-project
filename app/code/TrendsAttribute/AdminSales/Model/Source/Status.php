<?php
namespace TrendsAttribute\AdminSales\Model\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve status options array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'Active', 'label' => __('Active')],
            ['value' => 'Inactive', 'label' => __('Inactive')]
        ];
    }
}
