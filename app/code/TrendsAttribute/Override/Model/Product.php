<?php
namespace TrendsAttribute\Override\Model;

class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        $changeNamebyPreference = $this->_getData('name') . ' modified by Preference';
        return $changeNamebyPreference;
    }
}
