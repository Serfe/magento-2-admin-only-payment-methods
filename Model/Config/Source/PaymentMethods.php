<?php
/**
 * Serfe S.A.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Serfe license that is
 * available on the file COPYING.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Serfe
 * @package     Serfe_AdminOnlyPayments
 * @copyright   Copyright (c) Serfe S.A. (https://www.serfe.com/)
 */

namespace Serfe\AdminOnlyPayments\Model\Config\Source;

use Magento\Payment\Model\Config;

class PaymentMethods implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Payment\Model\Config
     */
    protected $paymentConfig;

    /**
     *
     * @param \Magento\Payment\Model\Config $paymentConfig
     */
    public function __construct(
        Config $paymentConfig
    ) {
        $this->paymentConfig = $paymentConfig;
    }

    /**
     * Converts list to an string array
     *
     * @return array<mixed>
     */
    public function toOptionArray()
    {
        $methods = [];
        foreach ($this->paymentConfig->getActiveMethods() as $code => $method) {
            $methods[] = [
                'value' => $code,
                'label' => $method->getTitle(),
            ];
        }
        return $methods;
    }
}
