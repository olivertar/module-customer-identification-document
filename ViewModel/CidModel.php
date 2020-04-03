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

namespace Mugar\CustomerIdentificationDocument\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order;
use Mugar\CustomerIdentificationDocument\Api\CidFieldsRepositoryInterface;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class CidModel implements ArgumentInterface
{

    /**
     * @var CidFieldsRepositoryInterface
     */
    protected $cidFieldsRepository;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**+
     * @var RequestInterface
     */
    protected $request;

    /**
     * CidModel constructor.
     * @param CidFieldsRepositoryInterface $cidFieldsRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param RequestInterface $requestInterface
     * @param array $data
     */
    public function __construct(
        CidFieldsRepositoryInterface $cidFieldsRepository,
        OrderRepositoryInterface $orderRepository,
        RequestInterface $requestInterface,
        array $data = []
    ) {
        $this->cidFieldsRepository = $cidFieldsRepository;
        $this->orderRepository = $orderRepository;
        $this->request = $requestInterface;
    }

    /**
     * Get Order
     * @return bool|Order
     */
    protected function getOrder(): Order
    {
        $id = $this->request->getParam('order_id');
        try {
            $order = $this->orderRepository->get($id);
        } catch (NoSuchEntityException $e) {
            return false;
        } catch (InputException $e) {
            return false;
        }
        return $order;
    }

    /**
     * Get Cid fields
     * @return bool|CidFieldsInterface
     * @throws NoSuchEntityException
     */
    public function getCidFields()
    {
        if ($order = $this->getOrder()) {
            return $this->cidFieldsRepository->getCidFields($order);
        }
        return false;
    }
}
