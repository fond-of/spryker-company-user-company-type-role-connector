<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidator;
use Spryker\Glue\Kernel\Container;

class CompanyUserCompanyTypeRolesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiFactory
     */
    protected $companyUserCompanyTypeRolesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|CompanyUserCompanyTypeRolesRestApiConfig
     */
    protected $companyUserCompanyTypeRolesRestApiConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
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

        $this->companyUserCompanyTypeRolesRestApiFactory = new CompanyUserCompanyTypeRolesRestApiFactory();
        $this->companyUserCompanyTypeRolesRestApiFactory->setContainer($this->containerMock);
        $this->companyUserCompanyTypeRolesRestApiFactory->setConfig($this->companyUserCompanyTypeRolesRestApiConfigMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCompanyTypeRoleSearchValidator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY],
                [CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_ROLE],
                [CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_TYPE]
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyUserCompanyTypeRolesRestApiToCompanyClientMock,
                $this->companyUserCompanyTypeRolesRestApiToCompanyRoleClientMock,
                $this->companyUserCompanyTypeRolesRestApiToCompanyTypeClientMock
            );

        $this->assertInstanceOf(
            CompanyUserCompanyTypeRolesSearchValidator::class,
            $this->companyUserCompanyTypeRolesRestApiFactory->createCompanyUserCompanyTypeRoleSearchValidator()
        );
    }
}
