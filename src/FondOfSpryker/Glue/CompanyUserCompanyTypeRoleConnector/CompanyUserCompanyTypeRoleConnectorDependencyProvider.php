<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector;

use FondOfSpryker\Glue\CompanyUserCompanyRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompanyUserCompanyTypeRoleConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY_ROLE = 'CLIENT_COMPANY_ROLE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCompanyRoleClient($container);

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
            return new CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientBridge(
                $container->getLocator()->companyRole()->client()
            );
        };

        return $container;
    }
}
