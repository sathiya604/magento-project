<?php

namespace TrendsAttribute\EventObserver\Observer;

/**
 * observer class for event trendsattribute_eventobserver_message
 */
class ChangeDisplayMessage implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('text');
        echo $displayText->getText() . " - Event </br>";
        $displayText->setText('Execute event successfully.');
        echo $displayText->getText() . " - Event </br>";
    }
}
