<?php

namespace FondOfSpryker\Client\CompanyUserCompanyTypeRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiDependencyProvider;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyRole\CompanyRoleClientInterface;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\Kernel\Locator;
use Spryker\Shared\Kernel\BundleProxy;

class CompanyUserCompanyTypeRolesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyCompanyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyCompanyRoleMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyCompanyTypeMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiDependencyProvider
     */
    protected $companyUserCompanyTypeRolesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
     */
    protected $companyClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
     */
    protected $companyRoleClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
     */
    protected $companyTypeClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyCompanyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyCompanyRoleMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyCompanyTypeMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeClientMock = $this->getMockBuilder(CompanyTypeClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleClientMock = $this->getMockBuilder(CompanyRoleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiDependencyProvider = new CompanyUserCompanyTypeRolesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['company'],
                ['companyType'],
                ['companyRole']
            )
            ->willReturnOnConsecutiveCalls(
                $this->bundleProxyCompanyMock,
                $this->bundleProxyCompanyTypeMock,
                $this->bundleProxyCompanyRoleMock
            );

        $this->bundleProxyCompanyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturn($this->companyClientMock);

        $this->bundleProxyCompanyTypeMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturn($this->companyTypeClientMock);

        $this->bundleProxyCompanyRoleMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturn($this->companyRoleClientMock);

        $container = $this->companyUserCompanyTypeRolesRestApiDependencyProvider->provideDependencies(
            $this->containerMock
        );

        $this->assertEquals($this->containerMock, $container);
        $this->assertInstanceOf(
            CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge::class,
            $container[CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY]
        );

        $this->assertInstanceOf(
            CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge::class,
            $container[CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_TYPE]
        );

        $this->assertInstanceOf(
            CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge::class,
            $container[CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_ROLE]
        );
    }
}
