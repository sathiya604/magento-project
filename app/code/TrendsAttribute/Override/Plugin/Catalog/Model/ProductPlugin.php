<?php
namespace TrendsAttribute\Override\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ProductPlugin
{
    public function afterGetName(Product $subject, $result)
    {
        return $result . ' After Plugin';
    }

    public function afterGetPrice(Product $subject, $result)
    {
        return $result+ 5;
    }
}
