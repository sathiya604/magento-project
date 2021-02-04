<?php
namespace TrendsAttribute\Feedback\Block\Adminhtml\Feedback\Edit;

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
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_Feedback::commentui');
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

        $form->setHtmlIdPrefix('feedback_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
        );

        $fieldset->addField(
            'name',
            'text',
            [
               'name' => 'name',
               'label' => __('Name'),
               'id' => 'name',
               'title' => __('Name'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'email',
            'text',
            [
               'name' => 'email',
               'label' => __('Email'),
               'id' => 'email',
               'title' => __('Email'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => false,
           ]
        );

        $fieldset->addField(
            'feedback',
            'text',
            [
               'name' => 'feedback',
               'label' => __('Feedback'),
               'id' => 'feedback',
               'title' => __('Feedback'),
               'class' => 'required-entry',
               'required' => true,
               'disabled' => false,
           ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
