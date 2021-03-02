<?php
namespace TrendsAttribute\AdminGrid\Block\Adminhtml;

class Feedback extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'TrendsAttribute_AdminGrid';
        $this->_headerText = __('Feedback');
        $this->_addButtonLabel = __('Add Feedback');
        parent::_construct();
    }
}
