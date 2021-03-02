<?php
namespace Task\ShippingPlace\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
            \Magento\Customer\Api\AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            'ship_to',
            [
                'label' => 'Ship To',
                'input' => 'select',
                'type' => 'varchar',
                'source' => 'Task\ShippingPlace\Model\Source\Ship',
                'required' => false,
                'position' => 333,
                'visible' => true,
                'system' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
                'backend' => ''
            ]
        );

        $attribute = $customerSetup->getEavConfig()
            ->getAttribute(
                \Magento\Customer\Api\AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
                'ship_to'
            )
            ->addData([
                'used_in_forms' => [
                  'adminhtml_customer_address',
                  'adminhtml_customer',
                  'customer_address_edit',
                  'customer_register_address',
                  'customer_address',
                ]
            ]);
        $attribute->save();
    }
}
