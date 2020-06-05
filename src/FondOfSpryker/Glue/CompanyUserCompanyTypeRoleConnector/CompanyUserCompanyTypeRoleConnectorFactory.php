<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidator;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUserCompanyTypeRoleConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator\CompanyUserCompanyTypeRoleSearchValidatorInterface
     */
    public function createCompanyUserCompanyTypeRoleSearchValidator(): CompanyUserCompanyTypeRoleSearchValidatorInterface
    {
        return new CompanyUserCompanyTypeRoleSearchValidator(
            $this->getCompanyClient(),
            $this->getCompanyRoleClient(),
            $this->getCompanyTypeClient(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
     */
    protected function getCompanyRoleClient(): CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRoleConnectorDependencyProvider::CLIENT_COMPANY_ROLE);
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface
     */
    protected function getCompanyClient(): CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRoleConnectorDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface
     */
    protected function getCompanyTypeClient(): CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyTypeRoleConnectorDependencyProvider::CLIENT_COMPANY_TYPE);
    }
}
