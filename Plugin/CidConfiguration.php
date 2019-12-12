<?php
/**
 * Customer Identification Document
 *
 * @category   Mugar
 * @package    Mugar_CustomerIdentificationDocument
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author     Mugar (https://www.mugar.io/)
 *
 */

namespace Mugar\CustomerIdentificationDocument\Plugin;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class CidConfiguration {

    public function afterProcess(
        LayoutProcessor $processor,
        array $jsLayout
    ){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $shipping_enable = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('checkout/cid/shipping_enabled');
        $billing_enable = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('checkout/cid/billing_enabled');

        if(!$shipping_enable){
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['cid-shipping-form']['config']['componentDisabled'] = true;
        }
        
        if(!$billing_enable){
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['cid-billing-form']['config']['componentDisabled'] = true;
        }

        return $jsLayout;
    }
}