<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidator;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUserCompanyTypeRoleConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidatorInterface
     */
    public function createCompanyUserCompanyRoleSearchValidator(): CompanyUserCompanyTypeRoleSearchValidatorInterface
    {
        return new CompanyUserCompanyTypeRoleSearchValidator(
            $this->getCompanyRoleClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
     */
    protected function getCompanyRoleClient(): CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRoleConnectorDependencyProvider::CLIENT_COMPANY_ROLE);
    }
}
