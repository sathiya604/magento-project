<?php
namespace TrendsAttribute\AdminGrid\Controller\Adminhtml\Index;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
    * @var \Magento\Framework\View\Result\PageFactory
    */
    public function execute()
    {
        $ids = $this->getRequest()->getParam("ids");
        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__("Please select products."));
        } else {
            try {
                foreach ($ids as $id) {
                    $row = $this->_objectManager->get("TrendsAttribute\AdminGrid\Model\Feedback")->load($id);
                    $row->setData("status", 0);
                    $row->save();
                }
                $this->messageManager->addSuccess(
                    __("A total of %1 record(s) have been deleted.", count($ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect("*/*/");
    }
}
