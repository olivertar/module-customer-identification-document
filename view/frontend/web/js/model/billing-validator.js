define(
    [
        'jquery',
        'mage/validation'
    ],
    function ($) {
        'use strict';

        return {

            /**
             * Validate checkout agreements
             *
             * @returns {Boolean}
             */
            validate: function () {
                let isValid = false;
                if (!$('[name="billing_cid_number"]').length) return true;

                let value = $('[name="billing_cid_number"]').val();
                if (value!=='') {
                    switch ($('[name="billing_cid_type"]').val()) {
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
            }
        };
    }
);
