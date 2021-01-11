<?php

namespace TrendsAttribute\PageDetail\Block;

class Link extends \Magento\Framework\View\Element\Html\Link
{
    /**
    * Render block HTML.
    *
    * @return string
    */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
        return '<a ' . $this->getLinkAttributes() . ' ><span>' . $this->escapeHtml($this->getLabel()) . '</span></a>';
    }
}
