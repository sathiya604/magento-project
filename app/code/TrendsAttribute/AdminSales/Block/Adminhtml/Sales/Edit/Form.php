<?php
namespace TrendsAttribute\AdminSales\Block\Adminhtml\Sales\Edit;

/**
* Adminhtml Add New Row Form.
*/
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \TrendsAttribute\AdminSales\Model\Source\Status $status,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_AdminSales::productsales');
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                           'id' => 'edit_form',
                           'enctype' => 'multipart/form-data',
                           'action' => $this->getData('action'),
                           'method' => 'post'
                       ]
           ]
        );

        $form->setHtmlIdPrefix('customsales_');
        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('item_id', 'hidden', ['name' => 'item_id']);
        }

        $fieldset->addField(
            'increment_id',
            'text',
            [
               'name' => 'order_id',
               'label' => __('Order Id'),
               'id' => 'order_id',
               'title' => __('Order Id'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => true,
           ]
        );

        $fieldset->addField(
            'customer_email',
            'text',
            [
               'name' => 'email',
               'label' => __('Email'),
               'id' => 'email',
               'title' => __('Email'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => true,
           ]
        );

        $fieldset->addField(
            'sku',
            'text',
            [
               'name' => 'sku',
               'label' => __('Sku'),
               'id' => 'sku',
               'title' => __('Sku'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => true,
           ]
        );

        $fieldset->addField(
            'clothing_material',
            'text',
            [
               'name' => 'clothing_material',
               'label' => __('Clothing Material'),
               'id' => 'clothing_material',
               'title' => __('Clothing Material'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => true,
           ]
        );

        $fieldset->addField(
            'change_status',
            'select',
            [
               'name' => 'change_status',
               'label' => __('Change Status'),
               'id' => 'change_status',
               'title' => __('Status'),
               'class' => 'required-entry',
               'values' => $this->_status->toOptionArray(),
               'required' => true,
               'disabled' => false,
           ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
