<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyTypeResponseTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserCompanyTypeRolesSearchValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected $companyRoleTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeResponseTransfer
     */
    protected $companyTypeResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeTransfer
     */
    protected $companyTypeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidator
     */
    protected $companyUserCompanyTypeRolesSearchValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyRoleClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
     */
    protected $companyUserCompanyTypeRolesRestApiToCompanyTypeClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig
     */
    protected $companyUserCompanyTypeRolesRestApiConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeResponseTransferMock = $this->getMockBuilder(CompanyTypeResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeTransferMock = $this->getMockBuilder(CompanyTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyClientMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiConfigMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesSearchValidator = new CompanyUserCompanyTypeRolesSearchValidator(
            $this->companyUserCompanyTypeRolesRestApiToCompanyClientMock,
            $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientMock,
            $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientMock,
            $this->companyUserCompanyTypeRolesRestApiConfigMock
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $roles = new ArrayObject();
        $roles->append($this->companyRoleTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn(1);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getFkCompanyType')
            ->willReturn(1);

        $this->companyUserCompanyTypeRolesRestApiToCompanyClientMock->expects($this->atLeastOnce())
            ->method('getCompanyById')
            ->willReturn($this->companyTransferMock);

        $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientMock->expects($this->atLeastOnce())
            ->method('findCompanyTypeById')
            ->willReturn($this->companyTypeResponseTransferMock);

        $this->companyTypeResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyTypeResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTypeTransfer')
            ->willReturn($this->companyTypeTransferMock);

        $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientMock->expects($this->atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn('role_1');

        $this->companyTypeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn('type_1');

        $this->companyRoleCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getRoles')
            ->willReturn($roles);

        $this->companyUserCompanyTypeRolesRestApiConfigMock->expects($this->atLeastOnce())
            ->method('getAllowedCompanyUserCompanyRolesForSearch')
            ->willReturn(['role_1']);

        $validatorResponse = $this->companyUserCompanyTypeRolesSearchValidator->validate(
            $this->companyUserTransferMock
        );

        $this->assertIsBool($validatorResponse);
        $this->assertTrue($validatorResponse);
    }
}
