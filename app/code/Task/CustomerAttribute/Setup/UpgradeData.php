<?php

namespace Task\CustomerAttribute\Setup;

use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $customerSetupFactory;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer_address');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        if (version_compare($context->getVersion(), '1.0.4') < 0) {
            $customerSetup->addAttribute('customer_address', 'ship_to', [
               'label' => 'Ship To',
               'input' => 'select',
               'type' => 'varchar',
               'source' => 'Task\CustomerAttribute\Model\Source\Ship',
               'required' => false,
               'position' => 90,
               'visible' => true,
               'system' => false,
               'is_used_in_grid' => false,
               'is_visible_in_grid' => false,
               'is_filterable_in_grid' => false,
               'is_searchable_in_grid' => false,
               'frontend_input' => 'hidden',
               'backend' => ''
           ]);

            $attribute=$customerSetup->getEavConfig()
                ->getAttribute('customer_address', 'ship_to')
                ->addData(
                    [
                   'attribute_set_id' => $attributeSetId,
                   'attribute_group_id' => $attributeGroupId,
                   'used_in_forms' => [
                   'adminhtml_customer_address',
                   'adminhtml_customer',
                   'customer_address_edit',
                   'customer_register_address',
                   'customer_address',
                  ]
                ]
                );
            $attribute->save();
        }
    }
}
