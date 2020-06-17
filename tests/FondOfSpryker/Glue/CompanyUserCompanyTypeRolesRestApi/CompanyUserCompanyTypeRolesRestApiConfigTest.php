<?php

namespace FondOfSpryker\Zed\CompanyUserCompanyTypeRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig;
use FondOfSpryker\Shared\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConstants;

class CompanyUserCompanyTypeRolesRestApiConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig
     */
    protected $companyUserCompanyTypeRolesRestApiConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserCompanyTypeRolesRestApiConfig = new class() extends CompanyUserCompanyTypeRolesRestApiConfig {

            /**
             * @param string $key
             * @param mixed|null $default
             *
             * @return mixed
             */
            protected function get($key, $default = null)
            {
                if ($key === CompanyUserCompanyTypeRolesRestApiConstants::VALID_COMPANY_TYPE_COMPANY_ROLES_FOR_SEARCH_LIST) {
                    return [
                        'type_1' => ['role_1'],
                        'type_2' => ['role_2'],
                    ];
                }

                return parent::get($key, $default);
            }
        };
    }

    /**
     * @return void
     */
    public function testGetAllowedCompanyUserCompanyRolesForSearch(): void
    {
        $allowedCompanyTypeRolesForSearch = $this->companyUserCompanyTypeRolesRestApiConfig->getAllowedCompanyUserCompanyRolesForSearch();

        $this->assertIsArray($allowedCompanyTypeRolesForSearch);
        $this->assertEquals(2, count($allowedCompanyTypeRolesForSearch));
    }
}
