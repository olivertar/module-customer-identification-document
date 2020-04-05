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

namespace Mugar\CustomerIdentificationDocument\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Sales\Model\Order;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class CidFieldsRepository implements CidFieldsRepositoryInterface
{
    protected $cartRepository;

    protected $scopeConfig;

    protected $cidFields;

    /**
     * CidFieldsRepository constructor.
     * @param CartRepositoryInterface $cartRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param CidFieldsInterface $cidFields
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ScopeConfigInterface $scopeConfig,
        CidFieldsInterface $cidFields
    ) {
        $this->cartRepository = $cartRepository;
        $this->scopeConfig    = $scopeConfig;
        $this->cidFields   = $cidFields;
    }

    /**
     * Save Cid Shipping Fields
     * @param int $cartId
     * @param CidFieldsInterface $cidFields
     * @return CidFieldsInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveCidFields(int $cartId, CidFieldsInterface $cidFields): CidFieldsInterface
    {
        $cart = $this->cartRepository->getActive($cartId);
        if (!$cart->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 is empty', $cartId));
        }

        try {
            $cart->setData(
                CidFieldsInterface::SHIPPING_CID_TYPE,
                $cidFields->getShippingCidType()
            );
            $cart->setData(
                CidFieldsInterface::SHIPPING_CID_NUMBER,
                $cidFields->getShippingCidNumber()
            );

            $this->cartRepository->save($cart);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Customer identification document data could not be saved!'));
        }

        return $cidFields;
    }

    /**
     * Save Cid Billing Fields
     * @param int $cartId
     * @param CidFieldsInterface $cidFields
     * @return CidFieldsInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveCidBillingFields(int $cartId, CidFieldsInterface $cidFields): CidFieldsInterface
    {
        $cart = $this->cartRepository->getActive($cartId);
        if (!$cart->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 is empty', $cartId));
        }

        try {
            $cart->setData(
                CidFieldsInterface::BILLING_CID_TYPE,
                $cidFields->getBillingCidType()
            );
            $cart->setData(
                CidFieldsInterface::BILLING_CID_NUMBER,
                $cidFields->getBillingCidNumber()
            );

            $this->cartRepository->save($cart);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Customer identification document billing data could not be saved!'));
        }

        return $cidFields;
    }

    /**
     * Get Cid Fields
     * @param Order $order
     * @return CidFieldsInterface
     * @throws NoSuchEntityException
     */
    public function getCidFields(Order $order): CidFieldsInterface
    {
        if (!$order->getId()) {
            throw new NoSuchEntityException(__('Order %1 does not exist', $order));
        }

        $this->cidFields->setShippingCidType(
            $order->getData(CidFieldsInterface::SHIPPING_CID_TYPE)
        );
        $this->cidFields->setShippingCidNumber(
            $order->getData(CidFieldsInterface::SHIPPING_CID_NUMBER)
        );
        $this->cidFields->setBillingCidType(
            $order->getData(CidFieldsInterface::BILLING_CID_TYPE)
        );
        $this->cidFields->setBillingCidNumber(
            $order->getData(CidFieldsInterface::BILLING_CID_NUMBER)
        );

        return $this->cidFields;
    }
}
