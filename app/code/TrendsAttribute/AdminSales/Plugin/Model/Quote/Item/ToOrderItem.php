<?php
namespace TrendsAttribute\AdminSales\Plugin\Model\Quote\Item;

class ToOrderItem
{

/**
*
* @var type \Magento\Catalog\Model\Product
*/
    protected $productRepository;

    /**
    * @param \Magento\Catalog\Model\Product $productRepository
    */
    public function __construct(
        \Magento\Catalog\Model\Product $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
    *
    * @param \Magento\Quote\Model\Quote\Item\ToOrderItem $subject
    * @param \Vendorname\Modulename\Plugin\Model\Quote\Item\callable $proceed
    * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
    * @param type $additional
    * @return type
    */
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        callable $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
        $orderItem = $proceed($item, $additional);
        $productId = $item->getProduct()->getId();
        $product['clothing_material'] = unserialize($this->productRepository->load($productId));

        if (!empty($product->getClothingMaterial())) {
            $orderItem->setClothingMaterial($product->getClothingMaterial());
        }

        return $orderItem;
    }
}
