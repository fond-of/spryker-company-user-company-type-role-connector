<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface
     */
    protected $companyTypeClientMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeTransfer
     */
    protected $companyTypeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTypeClientMock = $this->getMockBuilder(CompanyTypeClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeTransferMock = $this->getMockBuilder(CompanyTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge =
            new CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge($this->companyTypeClientMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyTypeById(): void
    {
        $this->companyTypeClientMock->expects($this->atLeastOnce())
            ->method('getCompanyTypeById')
            ->with($this->companyTypeTransferMock)
            ->willReturn($this->companyTypeTransferMock);

        $this->assertInstanceOf(
            CompanyTypeTransfer::class,
            $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge->getCompanyTypeById($this->companyTypeTransferMock)
        );
    }
}
