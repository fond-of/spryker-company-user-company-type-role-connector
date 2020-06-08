<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\CompanyClientInterface;

class CompanyUserCompanyTypeRolesRestApiToCompanyClientBridge implements CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
{
    /**
     * @var \Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClient;

    /**
     * @param \Spryker\Client\Company\CompanyClientInterface $companyRoleClient
     */
    public function __construct(
        CompanyClientInterface $companyClient
    ) {
        $this->companyClient = $companyClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->companyClient->getCompanyById($companyTransfer);
    }
}
