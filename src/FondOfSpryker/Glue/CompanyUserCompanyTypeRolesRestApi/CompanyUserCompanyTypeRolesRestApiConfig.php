<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi;

use FondOfSpryker\Shared\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyUserCompanyTypeRolesRestApiConfig extends AbstractBundleConfig
{
    /**
     * @param string $companyType
     *
     * @return array
     */
    public function getAllowedCompanyUserCompanyRolesForSearch(string $companyType = ''): array
    {
        $companyRoles = $this->get(CompanyUserCompanyTypeRolesRestApiConstants::VALID_COMPANY_TYPE_COMPANY_ROLES_FOR_SEARCH_LIST, []);

        if ($companyType === '') {
            return $companyRoles;
        }

        if (!isset($companyRoles[$companyType])) {
            return [];
        }

        return $companyRoles[$companyType];
    }
}
