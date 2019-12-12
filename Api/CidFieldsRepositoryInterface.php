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

namespace Mugar\CustomerIdentificationDocument\Api;

use Magento\Sales\Model\Order;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

interface CidFieldsRepositoryInterface
{
    /**
     * Save Cid fields
     *
     * @param int $cartId Cart id
     * @param \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface $cidFields Cid fields
     *
     * @return \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface
     */
    public function saveCidFields(int $cartId, CidFieldsInterface $cidFields): CidFieldsInterface;
    
    /**
     * Save Cid billing fields
     *
     * @param int $cartId Cart id
     * @param \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface $cidFields Cid fields
     *
     * @return \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface
     */
    public function saveCidBillingFields(int $cartId, CidFieldsInterface $cidFields): CidFieldsInterface;

    /**
     * Get cid fields
     *
     * @param Order $order Order
     *
     * @return CidFieldsInterface
     */
    public function getCidFields(Order $order) : CidFieldsInterface;
}
