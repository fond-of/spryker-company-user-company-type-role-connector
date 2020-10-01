<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyTypeResponseTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;

interface CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
{

    /**
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTypeResponseTransfer
     */
    public function findCompanyTypeById(
        CompanyTypeTransfer $companyTypeTransfer
    ): CompanyTypeResponseTransfer;
}
