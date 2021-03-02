<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory;

class Add extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    protected $_itemFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Task\FlashSale\Model\ItemFactory $itemFactory,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->_itemFactory = $itemFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = 'Add Flash Sale';
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
