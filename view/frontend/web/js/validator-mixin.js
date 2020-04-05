define([
    'jquery',
    'underscore',
    'moment',
    'mage/translate'
], function ($, _, moment) {
    'use strict';

    return function (validator) {
        let validators = {
            'cid-validation': [
                function (value) {
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
                $.mage.__('Please insert a valid document format.')
            ]
        };

        validators = _.mapObject(validators, function (data) {
            return {
                handler: data[0],
                message: data[1]
            };
        });

        return $.extend(validator, validators);
    };
});
