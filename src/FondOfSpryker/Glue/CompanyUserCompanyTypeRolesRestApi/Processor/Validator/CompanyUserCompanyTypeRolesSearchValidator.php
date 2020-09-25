<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserCompanyTypeRolesSearchValidator implements CompanyUserCompanyTypeRolesSearchValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface
     */
    protected $companyClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface
     */
    protected $companyRoleClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface
     */
    protected $companyTypeClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface $companyClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface $companyRoleClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Dependency\Client\CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface $companyTypeClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig $config
     */
    public function __construct(
        CompanyUserCompanyTypeRolesRestApiToCompanyClientInterface $companyClient,
        CompanyUserCompanyTypeRolesRestApiToCompanyRoleClientInterface $companyRoleClient,
        CompanyUserCompanyTypeRolesRestApiToCompanyTypeClientInterface $companyTypeClient,
        CompanyUserCompanyTypeRolesRestApiConfig $config
    ) {
        $this->companyClient = $companyClient;
        $this->companyRoleClient = $companyRoleClient;
        $this->companyTypeClient = $companyTypeClient;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return bool
     */
    public function validate(CompanyUserTransfer $companyUserTransfer): bool
    {
        $companyTransfer = (new CompanyTransfer())->setIdCompany($companyUserTransfer->getFkCompany());
        $companyTransfer = $this->companyClient->getCompanyById($companyTransfer);

        if ($companyTransfer === null) {
            return false;
        }

        $companyTypeTransfer = (new CompanyTypeTransfer())->setIdCompanyType($companyTransfer->getFkCompanyType());
        $companyTypeResponseTransfer = $this->companyTypeClient->findCompanyTypeById($companyTypeTransfer);

        if ($companyTypeResponseTransfer->getIsSuccessful() == false
            || $companyTypeResponseTransfer->getCompanyTypeTransfer() === null
        ) {
            return false;
        }

        $companyRoleCriteriaFilterTransfer = new CompanyRoleCriteriaFilterTransfer();
        $companyRoleCriteriaFilterTransfer
            ->setIdCompany($companyUserTransfer->getFkCompany())
            ->setIdCompanyUser($companyUserTransfer->getIdCompanyUser());

        $companyRoleCollectionTransfer = $this->companyRoleClient
            ->getCompanyRoleCollection($companyRoleCriteriaFilterTransfer);

        if ($companyRoleCollectionTransfer === null) {
            return false;
        }

        if ($this->hasCompanyUserValidCompanyTypeRoles(
            $companyRoleCollectionTransfer,
            $companyTypeResponseTransfer->getCompanyTypeTransfer()
            ) === false) {
                return false;
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleCollectionTransfer $companyRoleCollectionTransfer
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     *
     * @return bool
     */
    protected function hasCompanyUserValidCompanyTypeRoles(
        CompanyRoleCollectionTransfer $companyRoleCollectionTransfer,
        CompanyTypeTransfer $companyTypeTransfer
    ): bool {

        foreach ($companyRoleCollectionTransfer->getRoles() as $companyRoleTransfer) {
            if (in_array(
                $companyRoleTransfer->getName(),
                $this->config->getAllowedCompanyUserCompanyRolesForSearch($companyTypeTransfer->getName())
            ) === true) {
                return true;
            }
        }

        return false;
    }
}
