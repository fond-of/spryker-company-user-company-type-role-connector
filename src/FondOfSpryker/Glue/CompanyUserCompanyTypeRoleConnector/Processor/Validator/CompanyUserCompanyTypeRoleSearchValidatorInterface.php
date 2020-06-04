<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRoleConnector\Processor\Validator;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserCompanyTypeRoleSearchValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return bool
     */
    public function validate(CompanyUserTransfer $companyUserTransfer): bool;
}
