<?php
namespace TrendsAttribute\EventObserver\ViewModel;

class Offer implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getOffer()
    {
        return "Buy 1 Get 1 Free";
    }
}
