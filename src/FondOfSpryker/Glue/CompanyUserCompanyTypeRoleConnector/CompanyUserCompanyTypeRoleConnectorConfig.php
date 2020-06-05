<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector;

use FondOfSpryker\Shared\CompanyUserCompanyTypeRoleConnector\CompanyUserCompanyTypeRoleConnectorConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyUserCompanyTypeRoleConnectorConfig extends AbstractBundleConfig
{
    /**
     * @param string $companyType
     *
     * @return array
     */
    public function getAllowedCompanyUserCompanyRolesForSearch(string $companyType = ''): array
    {
        $companyRoles = $this->get(CompanyUserCompanyTypeRoleConnectorConstants::VALID_COMPANY_TYPE_COMPANY_ROLES_FOR_SEARCH_LIST, []);

        if ($companyType === '') {
            return $companyRoles;
        }

        if (!isset($companyRoles[$companyType])) {
            return [];
        }

        return $companyRoles[$companyType];
    }
}
