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

namespace Serfe\StylesMover\Test\Unit\Helper;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class CssMoverHelperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $configMock;

    /**
     * @var \Magento\Framework\App\Helper\Context
     */
    private $contextMock;

    /**
     * @var \Serfe\StylesMover\Helper\CssMoverHelper
     */
    private $helper;
    
    /**
     * [setUp description]
     * @return void
     */
    public function setUp() : void
    {
        $objectManager = new ObjectManager($this);

        $this->configMock = $this->createMock('\Magento\Framework\App\Config\ScopeConfigInterface');
        
        $this->contextMock = $this->createMock('\Magento\Framework\App\Helper\Context');
        $this->contextMock->expects($this->once())->method('getScopeConfig')->will($this->returnValue($this->configMock));

        $this->helper = $objectManager->getObject(
            '\Serfe\AdminOnlyPayments\Helper\Config',
            [
                'context' => $this->contextMock,
                'scopeConfig' => $this->configMock
            ]
        );
    }
    
    public function test_is_enabled_on_config()
    {
        $this->configMock->expects($this->once())
             ->method('getValue')
             ->with($this->equalTo(\Serfe\AdminOnlyPayments\Helper\Config::XML_PATH_BACKENDPAYMENTS_ENABLE))
             ->will($this->returnValue(true));
        $this->assertSame($this->helper->isBackendPaymentsEnabled(), true);
    }

    public function test_is_disabled_on_config()
    {
        $this->configMock->expects($this->once())
             ->method('getValue')
             ->with($this->equalTo(\Serfe\AdminOnlyPayments\Helper\Config::XML_PATH_BACKENDPAYMENTS_ENABLE))
             ->will($this->returnValue(false));
        $this->assertSame($this->helper->isBackendPaymentsEnabled(), false);
    }

}

