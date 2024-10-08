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

namespace Serfe\AdminOnlyPayments\Plugin;

class RestrictPaymentMethod
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $backendSession;

    /**
     * @var \Serfe\AdminOnlyPayments\Helper\Config
     */
    protected $config;

    /**
     * @param \Magento\Backend\Model\Auth\Session $backendSession
     * @param \Serfe\AdminOnlyPayments\Helper\Config $config
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $backendSession,
        \Serfe\AdminOnlyPayments\Helper\Config $config
    ) {
        $this->backendSession = $backendSession;
        $this->config = $config;
    }
    
    /**
     * Interceptor
     *
     * @param \Magento\Quote\Api\Data\PaymentMethodInterface $subject
     * @param bool $result
     */
    public function afterIsAvailable(
        \Magento\Quote\Api\Data\PaymentMethodInterface $subject,
        bool $result
    ): bool {
        if ($this->config->isBackendPaymentsEnabled()
        && !$this->backendSession->isLoggedIn()) {
            $methodCode = $subject->getCode();
            if (in_array($methodCode, $this->config->getRestrictedMethods(), true)) {
                return false;
            }
        }
        return $result;
    }
}
