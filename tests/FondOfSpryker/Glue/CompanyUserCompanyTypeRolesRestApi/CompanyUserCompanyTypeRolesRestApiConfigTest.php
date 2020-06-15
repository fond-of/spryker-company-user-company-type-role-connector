<?php

namespace FondOfSpryker\Zed\CompanyUserCompanyTypeRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiConfig;
use org\bovigo\vfs\vfsStream;

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

        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('config_default.php')),
                ],
            ],
        ]);

        $this->companyUserCompanyTypeRolesRestApiConfig = new CompanyUserCompanyTypeRolesRestApiConfig();
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
