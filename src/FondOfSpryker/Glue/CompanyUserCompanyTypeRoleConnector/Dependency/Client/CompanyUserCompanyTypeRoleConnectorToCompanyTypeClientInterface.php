<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client;

use Generated\Shared\Transfer\CompanyTypeTransfer;

interface CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface
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
