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

namespace Mugar\CustomerIdentificationDocument\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Mugar\CustomerIdentificationDocument\Api\Data\CidFieldsInterface;

class InstallData implements InstallDataInterface
{
    protected $salesSetupFactory;

    protected $quoteSetupFactory;

    protected $setup;

    public function __construct(
        SalesSetupFactory $salesSetupFactory,
        QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $this->setup = $setup->startSetup();
        $this->installQuoteData();
        $this->installSalesData();
        $this->setup = $setup->endSetup();
    }

    public function installQuoteData()
    {
        $quoteInstaller = $this->quoteSetupFactory->create(
            [
                'resourceName' => 'quote_setup',
                'setup' => $this->setup
            ]
        );
        $quoteInstaller
            ->addAttribute(
                'quote',
                CidFieldsInterface::SHIPPING_CID_TYPE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            )
            ->addAttribute(
                'quote',
                CidFieldsInterface::SHIPPING_CID_NUMBER,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            )
            ->addAttribute(
                'quote',
                CidFieldsInterface::BILLING_CID_TYPE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            )
            ->addAttribute(
                'quote',
                CidFieldsInterface::BILLING_CID_NUMBER,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            );
    }

    public function installSalesData()
    {
        $salesInstaller = $this->salesSetupFactory->create(
            [
                'resourceName' => 'sales_setup',
                'setup' => $this->setup
            ]
        );
        $salesInstaller
            ->addAttribute(
                'order',
                CidFieldsInterface::SHIPPING_CID_TYPE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CidFieldsInterface::SHIPPING_CID_NUMBER,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CidFieldsInterface::BILLING_CID_TYPE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CidFieldsInterface::BILLING_CID_NUMBER,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            );
    }
}