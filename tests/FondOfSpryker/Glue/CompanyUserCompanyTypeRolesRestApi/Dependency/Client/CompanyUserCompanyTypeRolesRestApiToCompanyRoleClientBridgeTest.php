<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Spryker\Client\CompanyRole\CompanyRoleClientInterface;

class CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyRole\CompanyRoleClientInterface
     */
    protected $companyRoleClientMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer
     */
    protected $companyRoleCriteriaFilterTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleClientMock = $this->getMockBuilder(CompanyRoleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCriteriaFilterTransferMock = $this->getMockBuilder(CompanyRoleCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge =
            new CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge($this->companyRoleClientMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyRoleCollection(): void
    {
        $this->companyRoleClientMock->expects($this->atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->with($this->companyRoleCriteriaFilterTransferMock)
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->assertInstanceOf(
            CompanyRoleCollectionTransfer::class,
            $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge->getCompanyRoleCollection($this->companyRoleCriteriaFilterTransferMock)
        );
    }
}
