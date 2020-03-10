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
use Magento\Framework\Exception\NoSuchEntityException;
use Mugar\CustomerIdentificationDocument\Helper\Data;

class CidConfiguration {

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
    ){
        if (!$this->helper->isShippingEnabled()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['cid-shipping-form']['config']['componentDisabled'] = true;
        }

        if (!$this->helper->isBillingEnabled()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['cid-billing-form']['config']['componentDisabled'] = true;
        }

        return $jsLayout;
    }
}