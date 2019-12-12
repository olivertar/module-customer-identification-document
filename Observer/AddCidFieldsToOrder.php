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

namespace Mugar\CustomerIdentificationDocument\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class AddCidFieldsToOrder implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData(
            CidFieldsInterface::SHIPPING_CID_TYPE,
            $quote->getData(CidFieldsInterface::SHIPPING_CID_TYPE)
        );
        $order->setData(
            CidFieldsInterface::SHIPPING_CID_NUMBER,
            $quote->getData(CidFieldsInterface::SHIPPING_CID_NUMBER)
        );
        $order->setData(
            CidFieldsInterface::BILLING_CID_TYPE,
            $quote->getData(CidFieldsInterface::BILLING_CID_TYPE)
        );
        $order->setData(
            CidFieldsInterface::BILLING_CID_NUMBER,
            $quote->getData(CidFieldsInterface::BILLING_CID_NUMBER)
        );
    }
}
