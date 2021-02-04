<?php
namespace TrendsAttribute\Feedback\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    protected $_feedbackFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \TrendsAttribute\Feedback\Model\FeedbackFactory $feedbackFactory
    ) {
        $this->_feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }
    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('uifeedback/index/index');
            return;
        }
        try {
            $rowData = $this->_feedbackFactory->create()->load('');
            $rowData->setData('name', $data['name']);
            $rowData->setData('email', $data['email']);
            $rowData->setData('feedback', $data['feedback']);
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect("*/*/");
    }
}
