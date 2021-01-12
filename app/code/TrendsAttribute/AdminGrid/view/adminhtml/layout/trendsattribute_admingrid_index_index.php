<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="styles"/>
    <body>
        <referenceContainer name="content">
            <block class="TrendsAttribute\AdminGrid\Block\Adminhtml\Post" name="trendsattribute_feedback_grid">
                <block class="Magento\Backend\Block\Widget\Grid" name="trendsattribute_feedback_grid.grid" as="grid">
                    <arguments>
                        <argument name="id" xsi:type="string">id</argument>
                        <argument name="dataSource" xsi:type="object">TrendsAttribute\AdminGrid\Model\ResourceModel\Feedback\Collection</argument>
                        <argument name="default_sort" xsi:type="string">id</argument>
                        <argument name="default_dir" xsi:type="string">ASC</argument>
                        <argument name="save_parameters_in_session" xsi:type="string">1</argument>
                    </arguments>
                    <block class="Magento\Backend\Block\Widget\Grid\ColumnSet" name="trendsattribute_feedback_grid.grid.columnSet" as="grid.columnSet">
                        <arguments>
                            <argument name="rowUrl" xsi:type="array">
                                <item name="path" xsi:type="string">*/*/edit</item>
                            </argument>
                        </arguments>
                        <block class="Magento\Backend\Block\Widget\Grid\Column" as="id">
                            <arguments>
                                <argument name="header" xsi:type="string" translate="true">ID</argument>
                                <argument name="index" xsi:type="string">id</argument>
                                <argument name="type" xsi:type="string">text</argument>
                                <argument name="column_css_class" xsi:type="string">col-id</argument>
                                <argument name="header_css_class" xsi:type="string">col-id</argument>
                            </arguments>
                        </block>
                        <block class="Magento\Backend\Block\Widget\Grid\Column" as="name">
                            <arguments>
                                <argument name="header" xsi:type="string" translate="true">Name</argument>
                                <argument name="index" xsi:type="string">name</argument>
                                <argument name="type" xsi:type="string">text</argument>
                                <argument name="column_css_class" xsi:type="string">col-id</argument>
                                <argument name="header_css_class" xsi:type="string">col-id</argument>
                            </arguments>
                        </block>
                        <block class="Magento\Backend\Block\Widget\Grid\Column" as="email">
                            <arguments>
                                <argument name="header" xsi:type="string" translate="true">Email</argument>
                                <argument name="index" xsi:type="string">email</argument>
                                <argument name="type" xsi:type="string">text</argument>
                                <argument name="column_css_class" xsi:type="string">col-id</argument>
                                <argument name="header_css_class" xsi:type="string">col-id</argument>
                            </arguments>
                        </block>
                        <block class="Magento\Backend\Block\Widget\Grid\Column" as="feedback">
                            <arguments>
                                <argument name="header" xsi:type="string" translate="true">Feedback</argument>
                                <argument name="index" xsi:type="string">feedback</argument>
                                <argument name="type" xsi:type="string">textarea</argument>
                                <argument name="column_css_class" xsi:type="string">col-id</argument>
                                <argument name="header_css_class" xsi:type="string">col-id</argument>
                            </arguments>
                        </block>
                    </block>
                </block>
            </block>
        </referenceContainer>
    </body>
</page>
