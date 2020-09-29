<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyTypeResponseTransfer;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeResponseTransfer
     */
    protected $companyTypeResponseTransferMock;

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

        $this->companyTypeResponseTransferMock = $this->getMockBuilder(CompanyTypeResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge =
            new CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge($this->companyTypeClientMock);
    }

    /**
     * @return void
     */
    public function testFindCompanyTypeById(): void
    {
        $this->companyTypeClientMock->expects($this->atLeastOnce())
            ->method('findCompanyTypeById')
            ->with($this->companyTypeTransferMock)
            ->willReturn($this->companyTypeResponseTransferMock);

        $this->assertInstanceOf(
            CompanyTypeResponseTransfer::class,
            $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge->findCompanyTypeById($this->companyTypeTransferMock)
        );
    }
}
