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
            cidBillingFieldsData: ko.observable(null),
        
	        validate: function () {
	            var canRun = true;
	            var billing_cid_number = $("input[name=billing_cid_number]").val();
	            var reg_checkout_additional_name=/^[0-9]{6,8}$/;
	       	
	            if(billing_cid_number == '' || !reg_checkout_additional_name.test(billing_cid_number) ){
	                var canRun = false;
	            }
	            return canRun;
	    	}
        
        }
    }
);