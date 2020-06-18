<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompanyUserCompanyTypeRolesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY_ROLE = 'CLIENT_COMPANY_ROLE';
    public const CLIENT_COMPANY = 'CLIENT_COMPANY';
    public const CLIENT_COMPANY_TYPE = 'CLIENT_COMPANY_TYPE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addCompanyClient($container);
        $container = $this->addCompanyRoleClient($container);
        $container = $this->addCompanyTypeClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY] = static function (Container $container) {
            return new CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge(
                $container->getLocator()->company()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyRoleClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_ROLE] = static function (Container $container) {
            return new CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientBridge(
                $container->getLocator()->companyRole()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyTypeClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_TYPE] = static function (Container $container) {
            return new CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge(
                $container->getLocator()->companyType()->client()
            );
        };

        return $container;
    }
}
