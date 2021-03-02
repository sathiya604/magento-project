<?php
namespace TrendsAttribute\CustomSales\Controller\Adminhtml\Index;

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
                    $row = $this->_objectManager->get("TrendsAttribute\CustomSales\Model\Item")->load($id);
                    $row->setData("change_status", 'Inactive');
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
