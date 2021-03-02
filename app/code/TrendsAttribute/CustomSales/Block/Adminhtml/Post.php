<?php
namespace TrendsAttribute\CustomSales\Block\Adminhtml;

class Post extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'TrendsAttribute_CustomSales';
        $this->_headerText = __('Posts');
        $this->_addButtonLabel = __('Create New Order');
        parent::_construct();
    }
}
