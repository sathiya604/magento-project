<?php
namespace TrendsAttribute\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use TrendsAttribute\Feedback\Model\FeedbackFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;
    protected $feedback;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        FeedbackFactory $feedback
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->feedback = $feedback;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postIndexs = $this->getRequest()->getParam('items', []);
            if (!count($postIndexs)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postIndexs) as $bannerId) {
                    /** @var \TrendsAttribute\Feedback\Model\Feedback $model */
                    $model = $this->feedback->create();
                    $model->load($bannerId);
                    try {
                        $model->setData(array_merge($model->getData(), $postIndexs[$bannerId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithIndexId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add banner name to error message
     *
     * @param \TrendsAttribute\Feedback\Model\Feedback $banner
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithIndexId(\TrendsAttribute\Feedback\Model\Feedback $banner, $errorText)
    {
        return '[Index ID: ' . $banner->getId() . '] ' . $errorText;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_Feedback::commentui');
    }
}
