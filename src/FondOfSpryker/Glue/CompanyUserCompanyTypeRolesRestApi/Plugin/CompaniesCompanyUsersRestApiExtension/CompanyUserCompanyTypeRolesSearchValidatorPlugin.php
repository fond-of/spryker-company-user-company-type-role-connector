<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Plugin\CompaniesCompanyUsersRestApiExtension;

use FondOfSpryker\Glue\CompaniesCompanyUsersRestApiExtension\Dependency\Plugin\CompanyCompanyUserSearchValidatorPluginInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiFactory getFactory()
 */
class CompanyUserCompanyTypeRolesSearchValidatorPlugin extends AbstractPlugin implements CompanyCompanyUserSearchValidatorPluginInterface
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
        return $this->getFactory()->createCompanyUserCompanyTypeRoleSearchValidator()->validate($companyUserTransfer);
    }
}
