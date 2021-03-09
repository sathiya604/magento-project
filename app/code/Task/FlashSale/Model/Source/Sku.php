<?php
namespace Task\FlashSale\Model\Source;

class Sku implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct()
    {
    }
    /**
     * Retrieve status options array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $sku = [];
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection = $productCollection->create()
          ->addAttributeToSelect('sku')
          ->load();
        $i = 0;
        foreach ($collection as $product) {
            $sku[$i++]=  ['value' => $product->getSku(), 'label' => __($product->getSku())];
        }
        return $sku;
    }
}
