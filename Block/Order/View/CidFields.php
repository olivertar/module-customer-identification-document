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

namespace Mugar\CustomerIdentificationDocument\Block\Order\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;

class CidFields extends Template
{

    protected $coreRegistry = null;

    protected $cidFieldsRepository;

    public function __construct(
        Context $context,
        Registry $registry,
        CidFieldsRepositoryInterface $cidFieldsRepository,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->cidFieldsRepository = $cidFieldsRepository;
        $this->_isScopePrivate = true;
        $this->_template = 'Mugar_CustomerIdentificationDocument::order/view/cid_fields.phtml';
        parent::__construct($context, $data);
    }

    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getCidFields(Order $order)
    {
        return $this->cidFieldsRepository->getCidFields($order);
    }
}
