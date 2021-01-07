<?php
namespace TrendsAttribute\EventObserver\Controller\Index;

class Event extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $message = new \Magento\Framework\DataObject(['text'=>'This is a example text']);
        $this->_eventManager->dispatch('trendsattribute_eventobserver_message', ['text' => $message]);
    }
}
