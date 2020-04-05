define([
    'jquery'
], function($) {
    return function(validator) {
        validator.addRule(
            'cid-validation',
            function (value, item) {
                let isValid = false;
                if (value!=='') {
                    let cidFieldType  = $('[name="shipping_cid_type"]').length ?
                        $('[name="shipping_cid_type"]').val() :
                        $('[name="billing_cid_type"]').val();
                    switch (cidFieldType) {
                        case 'DNI':
                            let ex_regular_dni = /^\d{8}(?:[-\s]\d{4})?$/;
                            if (ex_regular_dni.test(value) == true) {
                                isValid = true;
                            }
                            break;
                        case 'CI':
                            let ex_regular_ci = /^\d{8}(?:[-\s]\d{4})?$/;
                            if (ex_regular_ci.test(value) == true) {
                                isValid = true;
                            }
                            break;
                        case 'Passport':
                            let ex_regular_passport = /^[a-z]{3}[0-9]{6}[a-z]?$/i;
                            if (ex_regular_passport.test(value) == true) {
                                isValid = true;
                            }
                            break;
                    }
                }
                return isValid;
            },
            $.mage.__('Document format invalid')
        );
        return validator;
    }
});
