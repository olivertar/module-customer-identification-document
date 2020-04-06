define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Mugar_CustomerIdentificationDocument/js/model/billing-validator'
    ],
    function (Component, additionalValidators, customValidator) {
        'use strict';
        additionalValidators.registerValidator(customValidator);
        return Component.extend({});
    }
);
