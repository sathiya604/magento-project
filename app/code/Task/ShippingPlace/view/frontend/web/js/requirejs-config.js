var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Task_ShippingPlace/js/action/set-shipping-information-mixin' : true
            }
        }
    },
    "map": {
        "*": {
            "Magento_Checkout/js/model/shipping-save-processor/default" : "Task_ShippingPlace/js/shipping-save-processor"
        }
    }

    map: {
       "*": {
          'Magento_Checkout/js/model/shipping-save-processor/payload-extender': 'Vendor_Module/js/model/shipping-save-processor/payload-extender-override'
       }
    }
};
