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

namespace Mugar\CustomerIdentificationDocument\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class CidFields extends AbstractExtensibleObject implements CidFieldsInterface
{

    public function getShippingCidType()
    {
        return $this->_get(self::SHIPPING_CID_TYPE);
    }

    public function getShippingCidNumber()
    {
        return $this->_get(self::SHIPPING_CID_NUMBER);
    }

    public function getBillingCidType()
    {
        return $this->_get(self::BILLING_CID_TYPE);
    }

    public function getBillingCidNumber()
    {
        return $this->_get(self::BILLING_CID_NUMBER);
    }

    public function setShippingCidType(string $shippingCidType = null)
    {
        return $this->setData(self::SHIPPING_CID_TYPE, $shippingCidType);
    }

    public function setShippingCidNumber(string $shippingCidNumber = null)
    {
        return $this->setData(self::SHIPPING_CID_NUMBER, $shippingCidNumber);
    }

    public function setBillingCidType(string $billingCidType = null)
    {
        return $this->setData(self::BILLING_CID_TYPE, $billingCidType);
    }

    public function setBillingCidNumber(string $billingCidNumber = null)
    {
        return $this->setData(self::BILLING_CID_NUMBER, $billingCidNumber);
    }
}
