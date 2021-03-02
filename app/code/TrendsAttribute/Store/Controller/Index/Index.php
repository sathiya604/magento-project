<?php
namespace TrendsAttribute\Store\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    public function execute()
    {
        /** @var Page $resultPage */
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
