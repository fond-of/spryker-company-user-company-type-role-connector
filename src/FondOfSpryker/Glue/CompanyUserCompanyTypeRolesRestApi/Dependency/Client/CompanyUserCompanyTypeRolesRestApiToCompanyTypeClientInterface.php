<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyTypeTransfer;

interface CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTypeTransfer
     */
    public function getCompanyTypeById(
        CompanyTypeTransfer $companyTypeTransfer
    ): CompanyTypeTransfer;
}
