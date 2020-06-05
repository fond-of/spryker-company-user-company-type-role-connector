<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator;

use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\CompanyUserCompanyTypeRoleConnectorConfig;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserCompanyTypeRoleSearchValidator implements CompanyUserCompanyTypeRoleSearchValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface
     */
    protected $companyClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface
     */
    protected $companyRoleClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface
     */
    protected $companyTypeClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\CompanyUserCompanyTypeRoleConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface $companyClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface $companyRoleClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Dependency\Client\CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface $companyTypeClient
     * @param \FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\CompanyUserCompanyTypeRoleConnectorConfig $config
     */
    public function __construct(
        CompanyUserCompanyTypeRoleConnectorToCompanyClientInterface $companyClient,
        CompanyUserCompanyTypeRoleConnectorToCompanyRoleClientInterface $companyRoleClient,
        CompanyUserCompanyTypeRoleConnectorToCompanyTypeClientInterface $companyTypeClient,
        CompanyUserCompanyTypeRoleConnectorConfig $config
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
        $companyTypeTransfer = $this->companyTypeClient->getCompanyTypeById($companyTypeTransfer);

        if ($companyTypeTransfer === null) {
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

        if ($this->hasCompanyUserValidCompanyTypeRoles($companyRoleCollectionTransfer, $companyTypeTransfer) === false) {
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
