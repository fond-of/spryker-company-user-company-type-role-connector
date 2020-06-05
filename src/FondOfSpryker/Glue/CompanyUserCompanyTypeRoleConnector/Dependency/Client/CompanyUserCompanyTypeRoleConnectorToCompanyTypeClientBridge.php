<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client;

use FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientBridge implements CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface
{
    /**
     * @var \FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface
     */
    protected $companyTypeClient;

    /**
     * @param \FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface $companyTypeClient
     */
    public function __construct(
        CompanyTypeClientInterface $companyTypeClient
    ) {
        $this->companyTypeClient = $companyTypeClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTypeTransfer
     */
    public function getCompanyTypeById(
        CompanyTypeTransfer $companyTypeTransfer
    ): CompanyTypeTransfer {
        return $this->companyTypeClient->getCompanyTypeById($companyTypeTransfer);
    }
}
