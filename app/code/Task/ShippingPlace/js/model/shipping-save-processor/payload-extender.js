define(function () {
    'use strict';

    return function (payload) {
        payload.addressInformation['extension_attributes'] = {
          'shipping_to':'shipping_to',
        };

        return payload;
    };
})
