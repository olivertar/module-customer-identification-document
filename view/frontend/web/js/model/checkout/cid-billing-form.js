define(
    [
        'ko',
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/url',
        'mage/validation'
    ],
    function(ko, $, modal, url) {
        'use strict';
        return{
            cidBillingFieldsData: ko.observable(null)
        }
    }
);
