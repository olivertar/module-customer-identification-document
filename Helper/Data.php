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

namespace Mugar\CustomerIdentificationDocument\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mugar\CustomerIdentificationDocument\Model\Config\Source\Types;

/**
 * Helper to get system config
 *
 * Php version 7.0^
 *
 * @category   Mugar
 * @package    Mugar_CustomerIdentificationDocument
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author     Mugar (https://www.mugar.io/)
 */
class Data extends AbstractHelper
{
    const SHIPPING_ENABLED = 'checkout/cid/shipping_enabled';
    const BILLING_ENABLED = 'checkout/cid/billing_enabled';
    const SHIPPING_DOCUMENT_TYPES = 'checkout/cid/shipping_types';
    const BILLING_DOCUMENT_TYPES = 'checkout/cid/billing_types';

    /**
     * Magento\Framework\App\Config\ScopeConfigInterface
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * Magento\Store\Model\StoreManagerInterface
     * @var StoreManagerInterface
     */
    private $_storeManager;

    private $_types;

    /**
     * Data constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfigInterface
     * @param StoreManagerInterface $storeManagerInterface
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfigInterface,
        StoreManagerInterface $storeManagerInterface,
        Types $types
    ) {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfigInterface;
        $this->_storeManager = $storeManagerInterface;
        $this->_types = $types;
    }

    /**
     * Check if shipping is enabled
     *
     * @param null $store
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function isShippingEnabled($store = null)
    {
        $storeId = is_null($store) ? $this->getStoreId() : $store->getId();
        return $this->getConfigValue(self::SHIPPING_ENABLED, $storeId);
    }

    /**
     * Check if billing is enabled
     *
     * @param null $store
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function isBillingEnabled($store = null)
    {
        $storeId = is_null($store) ? $this->getStoreId() : $store->getId();
        return $this->getConfigValue(self::BILLING_ENABLED, $storeId);
    }

    /**
     * get Shipping Document Types
     *
     * @param null $store
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getShippingDocumentTypes($store = null)
    {
        $optionsSelected = [];
        $storeId = is_null($store) ? $this->getStoreId() : $store->getId();
        $options = $this->_types->toOptionArray();
        $systemOptionsSelected = explode(',', $this->getConfigValue(self::SHIPPING_DOCUMENT_TYPES, $storeId));

        foreach ($options as $option) {
            if (in_array($option['value'], $systemOptionsSelected)) {
                $optionsSelected[$option['value']] = $option['label']->getText();
            }
        }

        return $optionsSelected;
    }

    /**
     * get Shipping Document Types
     *
     * @param null $store
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getBillingDocumentTypes($store = null)
    {
        $optionsSelected = [];
        $storeId = is_null($store) ? $this->getStoreId() : $store->getId();
        $options = $this->_types->toOptionArray();
        $systemOptionsSelected = explode(',', $this->getConfigValue(self::BILLING_DOCUMENT_TYPES, $storeId));

        foreach ($options as $option) {
            if (in_array($option['value'], $systemOptionsSelected)) {
                $optionsSelected[$option['value']] = $option['label']->getText();
            }
        }

        return $optionsSelected;
    }

    /**
     * Get configuration value
     *
     * @param $path
     * @param null $storeId
     * @param null $scope
     * @return mixed
     */
    public function getConfigValue($path, $storeId = null, $scope = null)
    {
        return is_null($scope) ?
            $this->_scopeConfig->getValue($path, ScopeInterface::SCOPE_STORES, $storeId) :
            $this->_scopeConfig->getValue($path, $scope, $storeId);
    }

    /**
     * Get store identifier
     *
     * @return  int
     * @throws NoSuchEntityException
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
}
