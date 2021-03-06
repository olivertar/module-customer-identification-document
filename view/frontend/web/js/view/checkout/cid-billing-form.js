/*global define*/
define([
    'knockout',
    'jquery',
    'mage/url',
    'Magento_Ui/js/form/form',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Checkout/js/model/error-processor',
    'Magento_Checkout/js/model/cart/cache',
    'Mugar_CustomerIdentificationDocument/js/model/checkout/cid-billing-form',
    'Magento_Checkout/js/model/payment/additional-validators',
    'Mugar_CustomerIdentificationDocument/js/model/billing-validator'
], function(ko, $, urlFormatter, Component, customer, quote, urlBuilder, errorProcessor, cartCache, formData, additionalValidators, customValidator) {
    'use strict';

    return Component.extend({
        cidFields: ko.observable(null),

        initialize: function () {
            var self = this;
            this._super();
            additionalValidators.registerValidator(customValidator);
            formData = this.source.get('cidBillingForm');
            var formDataCached = cartCache.get('cid-billing-form');
            if (formDataCached) {
                formData = this.source.set('cidBillingForm', formDataCached);
            }
            this.cidFields.subscribe(function(change){
                self.formData(change);
            });
            return this;
        },

        getCidLabel: function () {
            return window.checkoutConfig.cid_billing_label;
        },

        getCidDescription: function() {
            return window.checkoutConfig.cid_billing_description;
        },

        onFormSubmit: function () {

        },

        onFormChange: function () {
            this.saveCidFields();
        },

        saveCidFields: function() {
            if(this.source.get('cidBillingForm').billing_cid_type != '' && this.source.get('cidBillingForm').billing_cid_number != ''){
                var formData = this.source.get('cidBillingForm');
                var quoteId = quote.getQuoteId();
                var isCustomer = customer.isLoggedIn();
                var url;

                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-order-cid-billing-fields', {});
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-order-cid-billing-fields', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    cidFields: formData
                };
                var result = true;

                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: true
                }).done(
                    function (response) {
                        cartCache.set('cid-billing-form', formData);
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            }
        }
    });
});
