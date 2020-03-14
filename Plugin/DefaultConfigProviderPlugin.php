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

use Magento\Checkout\Model\DefaultConfigProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Mugar\CustomerIdentificationDocument\Helper\Data;

class DefaultConfigProviderPlugin
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

    /**
     * @param DefaultConfigProvider $subject
     * @param $output
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function afterGetConfig(
        DefaultConfigProvider $subject,
        $output
    ) {
        $moduleConfig = [
            'cid_shipping_label'        => $this->helper->getShippingLabel(),
            'cid_billing_label'         => $this->helper->getBillingLabel(),
            'cid_shipping_description'  => $this->helper->getShippingDescription(),
            'cid_billing_description'   => $this->helper->getBillingDescription()
        ];
        $output = array_merge($output, $moduleConfig);
        return $output;
    }
}
