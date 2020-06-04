<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Plugin\CompaniesCompanyUsersRestApiExtension;

use FondOfSpryker\Glue\CompaniesCompanyUsersRestApiExtension\Dependency\Plugin\CompanyCompanyUserSearchValidatorPluginInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\CompanyUserCompanyTypeRoleConnectorFactory getFactory()
 */
class CompanyUserCompanyTypeRoleSearchValidatorPlugin extends AbstractPlugin implements CompanyCompanyUserSearchValidatorPluginInterface
{
    /**
     * @inheritDoc
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return bool
     */
    public function validate(CompanyUserTransfer $companyUserTransfer): bool
    {
        return $this->getFactory()->createCompanyUserCompanyRoleSearchValidator()->validate($companyUserTransfer);
    }
}
