<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use FondOfSpryker\Client\CompanyType\CompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyTypeResponseTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientBridge implements CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
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
     * @return \Generated\Shared\Transfer\CompanyTypeResponseTransfer
     */
    public function findCompanyTypeById(
        CompanyTypeTransfer $companyTypeTransfer
    ): CompanyTypeResponseTransfer {
        return $this->companyTypeClient->findCompanyTypeById($companyTypeTransfer);
    }
}
