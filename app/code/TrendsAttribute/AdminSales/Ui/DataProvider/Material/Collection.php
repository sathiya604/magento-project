<?php
namespace TrendsAttribute\AdminSales\Ui\DataProvider\Material;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package TrendsAttribute\AdminSales\Ui\DataProvider\Material
 */
class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('sku', 'second_table.sku');
        $this->addFilterToMap('item_id', 'second_table.item_id');
        $this->addFilterToMap('clothing_material', 'second_table.clothing_material');
        $this->addFilterToMap('change_status', 'second_table.change_status');
        parent::_initSelect();
    }
}
