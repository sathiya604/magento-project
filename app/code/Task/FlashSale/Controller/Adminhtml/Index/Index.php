<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $value;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Task\FlashSale\Model\DataProvider $value
    ) {
        $this->_pageFactory = $pageFactory;
        $this->value = $value;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Flash Sale'));

        return $resultPage;
    }
}
