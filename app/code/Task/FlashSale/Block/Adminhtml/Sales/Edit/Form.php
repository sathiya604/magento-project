<?php
namespace Task\FlashSale\Block\Adminhtml\Sales\Edit;

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
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
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
        $form = $this->_formFactory->create(
            ['data' => [
                           'id' => 'edit_form',
                           'enctype' => 'multipart/form-data',
                           'action' => $this->getData('action'),
                           'method' => 'post'
                       ]
           ]
        );

        $form->setHtmlIdPrefix('flashsale_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('FlashSale'), 'class' => 'fieldset-wide']);

        $fieldset->addField(
            'flash_sale_name',
            'text',
            [
               'name' => 'flash_sale_name',
               'label' => __('Flash Sale Name'),
               'id' => 'flash_sale_name',
               'title' => __('Flash Sale Name'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'start_date_time',
            'date',
            [
               'name' => 'start_date_time',
               'label' => __('Start Date Time'),
               'id' => 'start_date_time',
               'title' => __('Start Date Time'),
               'date_format' => 'yyyy-MM-dd',
               'time_format' => 'HH:mm:ss',
               'class' => 'required-entry',
               'required' => true,
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'end_date_time',
            'date',
            [
               'name' => 'end_date_time',
               'label' => __('End Date Time'),
               'id' => 'end_date_time',
               'title' => __('End Date Time'),
               'class' => 'required-entry',
               'date_format' => 'yyyy-MM-dd',
               'time_format' => 'HH:mm:ss',
               'required' => true,
               'disabled' => false,
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
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'discount_percent',
            'text',
            [
               'name' => 'discount_percent',
               'label' => __('Discount Percentage'),
               'id' => 'discount_percent',
               'title' => __('Discount Percentage'),
               'class' => 'required-entry validate-number',
               'required' => true,
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'maximum_discount_amount',
            'text',
            [
               'name' => 'maximum_discount_amount',
               'label' => __('Maximum Discount Amount'),
               'id' => 'maximum_discount_amount',
               'title' => __('Maximum Discount Amount'),
               'class' => 'required-entry validate-number',
               'required' => true,
               'disabled' => false,
           ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
