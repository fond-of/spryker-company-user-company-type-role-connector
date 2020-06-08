<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserCompanyTypeRolesSearchValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return bool
     */
    public function validate(CompanyUserTransfer $companyUserTransfer): bool;
}
