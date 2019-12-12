var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Mugar_CustomerIdentificationDocument/js/view/shipping-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Mugar_CustomerIdentificationDocument/js/view/payment-mixin': true
            }
        }
    }
};