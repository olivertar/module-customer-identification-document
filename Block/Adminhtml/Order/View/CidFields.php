<?php
namespace Mugar\CustomerIdentificationDocument\Block\Adminhtml\Order\View;

use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;

class CidFields extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{
    /**
     * ContactType constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        CidFieldsRepositoryInterface $cidFieldsRepository,
        array $data = []
    ) {
        $this->cidFieldsRepository = $cidFieldsRepository;
        parent::__construct($context, $registry, $adminHelper, $data);
    }

    public function getCidFields()
    {
        return $this->cidFieldsRepository->getCidFields($this->getOrder());
    }
}