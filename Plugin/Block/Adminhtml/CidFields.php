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

namespace Mugar\CustomerIdentificationDocument\Plugin\Block\Adminhtml;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Block\Adminhtml\Order\View\Info;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;

class CidFields
{
    protected $cidFieldsRepository;

    public function __construct(CidFieldsRepositoryInterface $cidFieldsRepository)
    {
        $this->cidFieldsRepository = $cidFieldsRepository;
    }

    public function afterToHtml(Info $subject, $result) {
        $block = $subject->getLayout()->getBlock('order_cid_fields');
        if ($block !== false) {
            $block->setOrderCidFields(
                $this->cidFieldsRepository->getCidFields($subject->getOrder())
            );
            $result = $result . $block->toHtml();
        }

        return $result;
    }
}
