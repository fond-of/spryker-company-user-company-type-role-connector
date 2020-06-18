<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\CompanyClientInterface;

class CompanyUserCompanyTypeRolesRestApiToCompanyClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyClientMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyClientBridge =
            new CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge($this->companyClientMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyById(): void
    {
        $this->companyClientMock->expects($this->atLeastOnce())
            ->method('getCompanyById')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(
            CompanyTransfer::class,
            $this->companyUserCompanyTypeRolesRestApiToCompanyClientBridge->getCompanyById($this->companyTransferMock)
        );
    }
}
