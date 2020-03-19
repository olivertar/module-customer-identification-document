<?php

namespace Mugar\CustomerIdentificationDocument\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Types implements OptionSourceInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('DNI')],
            ['value' => 2, 'label' => __('CI')],
            ['value' => 3, 'label' => __('Passport')]
        ];
    }
}
