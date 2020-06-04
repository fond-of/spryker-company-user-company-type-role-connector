<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator;

use FondOfSpryker\Glue\CompanyUserCompanyRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserCompanyTypeRoleSearchValidator implements CompanyUserCompanyTypeRoleSearchValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
     */
    protected $companyRoleClient;

    /**
     * @param \FondOfSpryker\Glue\CompanyUserCompanyRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface $companyRoleClient
     */
    public function __construct(
        CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface $companyRoleClient
    ) {
        $this->companyRoleClient = $companyRoleClient;
    }

    /**
     * @inheritDoc
     */
    public function validate(CompanyUserTransfer $companyUserTransfer): bool
    {
        $companyRoleCriteriaFilterTransfer = new CompanyRoleCriteriaFilterTransfer();
        $companyRoleCriteriaFilterTransfer
            ->setIdCompany($companyUserTransfer->getFkCompany())
            ->setIdCompanyUser($companyUserTransfer->getIdCompanyUser());

        $companyRoleCollectionTransfer = $this->companyRoleClient->getCompanyRoleCollection($companyRoleCriteriaFilterTransfer);

        if ($companyRoleCollectionTransfer === null) {
            return false;
        }

        return true;
    }
}
