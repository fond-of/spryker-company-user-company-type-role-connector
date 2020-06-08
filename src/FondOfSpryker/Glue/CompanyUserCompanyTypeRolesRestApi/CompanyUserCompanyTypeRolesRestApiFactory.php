<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidator;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUserCompanyTypeRolesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidatorInterface
     */
    public function createCompanyUserCompanyTypeRoleSearchValidator(): CompanyUserCompanyTypeRolesSearchValidatorInterface
    {
        return new CompanyUserCompanyTypeRolesSearchValidator(
            $this->getCompanyClient(),
            $this->getCompanyRoleClient(),
            $this->getCompanyTypeClient(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
     */
    protected function getCompanyRoleClient(): CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_ROLE);
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
     */
    protected function getCompanyClient(): CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
     */
    protected function getCompanyTypeClient(): CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRolesRestApiDependencyProvider::CLIENT_COMPANY_TYPE);
    }
}
