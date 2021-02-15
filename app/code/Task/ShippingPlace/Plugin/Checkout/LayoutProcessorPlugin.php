<?php
namespace Task\ShippingPlace\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function afterProcess(LayoutProcessor $subject, array $jsLayout)
    {
        $customAttributeCode = 'shipping_to';

        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'tooltip' => [
                    'description' => 'this is Shipping Place field',
                ],
            ],

            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
            'label' => 'Shipping Place',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [
                [
                    'value' => '',
                    'label' => 'Please Select',
                ],
                [
                    'value' => 'Work',
                    'label' => 'Work',
                ],
                [
                    'value' => 'Home',
                    'label' => 'Home ',
                ]
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        return $jsLayout;
    }
}
