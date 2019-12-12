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

use Magento\Quote\Model\QuoteIdMaskFactory;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsGuestRepositoryInterface;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class CidFieldsGuestRepository implements CidFieldsGuestRepositoryInterface
{
    protected $quoteIdMaskFactory;

    protected $cidFieldsRepository;

    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        CidFieldsRepositoryInterface $cidFieldsRepository
    ) {
        $this->quoteIdMaskFactory     = $quoteIdMaskFactory;
        $this->cidFieldsRepository = $cidFieldsRepository;
    }

    public function saveCidFields(string $cartId, CidFieldsInterface $cidFields): CidFieldsInterface {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->cidFieldsRepository->saveCidFields((int)$quoteIdMask->getQuoteId(), $cidFields);
    }
    
    public function saveCidBillingFields(string $cartId, CidFieldsInterface $cidFields): CidFieldsInterface {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->cidFieldsRepository->saveCidBillingFields((int)$quoteIdMask->getQuoteId(), $cidFields);
    }
}
