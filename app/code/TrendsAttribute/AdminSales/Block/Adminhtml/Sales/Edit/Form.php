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
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'item_id',
            'text',
            [
               'name' => 'item_id',
               'label' => __('Item Id'),
               'id' => 'item_id',
               'title' => __('Item Id'),
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
            'text',
            [
               'name' => 'change_status',
               'label' => __('Change Status'),
               'id' => 'change_status',
               'title' => __('Status'),
               'class' => 'required-entry',
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
