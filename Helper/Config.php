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

namespace Serfe\AdminOnlyPayments\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Config extends AbstractHelper
{
    public const XML_PATH_BACKENDPAYMENTS_ENABLE = 'admin_only_payments/general/enable';
    public const XML_PATH_BACKENDPAYMENTS_RESTRICTED_METHODS = 'admin_only_payments/general/restricted_methods';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Is enabled or not the method
     *
     * @return bool
     */
    public function isBackendPaymentsEnabled() : bool
    {
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_BACKENDPAYMENTS_ENABLE);
    }

    /**
     * List of restricted method that only should appear on the frontend
     *
     * @return array<string>
     */
    public function getRestrictedMethods() : array
    {
        $restrictedMethods = $this->scopeConfig->getValue(self::XML_PATH_BACKENDPAYMENTS_RESTRICTED_METHODS);
        if (empty($restrictedMethods)) {
            return []; // No payment methods selected to the admin only.
        }
        return explode(',', "" . $restrictedMethods);
    }
}
