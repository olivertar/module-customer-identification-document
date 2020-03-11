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
use Mugar\CustomerIdentificationDocument\Helper\Data;

class CidConfiguration
{

    /**
     * Mugar\CustomerIdentificationDocument\Helper\Data
     * @var Data
     */
    protected $helper;

    /**
     * CidConfiguration constructor.
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    public function afterProcess(
        LayoutProcessor $processor,
        array $jsLayout
    ) {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/oliverio.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        if (!$this->helper->isShippingEnabled()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['cid-shipping-form']['config']['componentDisabled'] = true;
        }

        if (!$this->helper->isBillingEnabled()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['cid-billing-form']['config']['componentDisabled'] = true;
        }

        $currentOptions = $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['cid-shipping-form']['children']['cid-shipping-form-container']['children']['cid-shipping-form-fieldset']['children']['shipping_cid_type']['options'];

        foreach ($this->helper->getShippingDocumentTypes() as $k => $v) {
            $currentOptions[] = ['value' => $k, 'label' => $v];
        }

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['cid-shipping-form']['children']['cid-shipping-form-container']['children']['cid-shipping-form-fieldset']['children']['shipping_cid_type']['options'] = $currentOptions;

        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
        ['payment']['children']['cid-billing-form']['children']['cid-billing-form-container']['children']['cid-billing-form-fieldset']['children']['billing_cid_type']['options'] = $currentOptions;

        $logger->info(print_r($currentOptions, true));
        return $jsLayout;
    }
}
