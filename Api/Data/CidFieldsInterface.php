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

namespace Mugar\CustomerIdentificationDocument\Api\Data;

interface CidFieldsInterface
{
    const SHIPPING_CID_TYPE = 'shipping_cid_type';
    const SHIPPING_CID_NUMBER = 'shipping_cid_number';
    const BILLING_CID_TYPE = 'billing_cid_type';
    const BILLING_CID_NUMBER = 'billing_cid_number';

    /**
     * Get shipping cid type
     *
     * @return string|null
     */
    public function getShippingCidType();

    /**
     * Get shipping cid number
     *
     * @return string|null
     */
    public function getShippingCidNumber();

    /**
     * Get billing cid type
     *
     * @return string|null
     */
    public function getBillingCidType();

    /**
     * Get billing cid number
     *
     * @return string|null
     */
    public function getBillingCidNumber();
    
    /**
     * Set shipping cid type
     *
     * @param string|null $shippingCidType Cid Type
     *
     * @return CidFieldsInterface
     */
    public function setShippingCidType(string $shippingCidType = null);
    
    /**
     * Set shipping cid number
     *
     * @param string|null $shippingCidNumber Cid Number
     *
     * @return CidFieldsInterface
     */
    public function setShippingCidNumber(string $shippingCidNumber = null);
    
    /**
     * Set billing cid type
     *
     * @param string|null $billingCidType Cid Type
     *
     * @return CidFieldsInterface
     */
    public function setBillingCidType(string $billingCidType = null);
    
    /**
     * Set billing cid number
     *
     * @param string|null $billingCidNumber Cid Number
     *
     * @return CidFieldsInterface
     */
    public function setBillingCidNumber(string $billingCidNumber = null);
}