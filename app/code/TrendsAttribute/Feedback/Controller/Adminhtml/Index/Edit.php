<?php
namespace TrendsAttribute\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use TrendsAttribute\Feedback\Model\FeedbackFactory;

/**
 * Class Edit
 * @package TrendsAttribute\Feedback\Controller\Adminhtml\Index
 */
class Edit extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var ReviewsFactory
     */
    protected $_reviewFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $rawFactory
     * @param ReviewsFactory $_reviewFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        FeedbackFactory $_reviewFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->pageFactory = $rawFactory;
        $this->_reviewFactory = $_reviewFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = '';

        if ($rowId) {
            $rowData = $this->_reviewFactory->create()->load($rowId);
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('uifeedback/index/index');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $title = $rowId ? __('Edit Feedback ') : __('Add Feedback');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
