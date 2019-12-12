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

interface CidFieldsGuestRepositoryInterface
{
    /**
     * Save cid fields
     *
     * @param string $cartId Guest Cart id
     * @param \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface $cidFields cid fields
     *
     * @return \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface
     */
    public function saveCidFields(string $cartId, CidFieldsInterface $cidFields): CidFieldsInterface;

    /**
     * Save cid fields
     *
     * @param string $cartId Guest Cart id
     * @param \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface $cidFields cid fields
     *
     * @return \Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface
     */
    public function saveCidBillingFields(string $cartId, CidFieldsInterface $cidFields): CidFieldsInterface;
}
