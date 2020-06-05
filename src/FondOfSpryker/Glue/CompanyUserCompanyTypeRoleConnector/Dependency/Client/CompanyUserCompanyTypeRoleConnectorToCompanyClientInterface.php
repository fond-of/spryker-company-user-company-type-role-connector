<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;
}
