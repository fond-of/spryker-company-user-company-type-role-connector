<?php

namespace FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Plugin\CompaniesCompanyUsersRestApiExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiFactory;
use FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidatorInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUserCompanyTypeRolesSearchValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Plugin\CompaniesCompanyUsersRestApiExtension\CompanyUserCompanyTypeRolesSearchValidatorPlugin
     */
    protected $companyUserCompanyTypeRolesSearchValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\Processor\Validator\CompanyUserCompanyTypeRolesSearchValidatorInterface;
     */
    protected $CompanyUserCompanyTypeRolesSearchValidatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserCompanyTypeRolesRestApi\CompanyUserCompanyTypeRolesRestApiFactory
     */
    protected $companyUserCompanyTypeRolesRestApiFactoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesRestApiFactoryMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesSearchValidatorMock = $this->getMockBuilder(CompanyUserCompanyTypeRolesSearchValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyTypeRolesSearchValidatorPlugin = new CompanyUserCompanyTypeRolesSearchValidatorPlugin();

        if (!method_exists($this->companyUserCompanyTypeRolesSearchValidatorPlugin, 'setFactory')) {
            $this->companyUserCompanyTypeRolesSearchValidatorPlugin = new class() extends CompanyUserCompanyTypeRolesSearchValidatorPlugin {
                /**
                 * @var \Spryker\Glue\Kernel\AbstractFactory
                 */
                protected $factory;

                /**
                 * @param \Spryker\Glue\Kernel\AbstractFactory $factory
                 *
                 * @return void
                 */
                public function setFactory(AbstractFactory $factory): void
                {
                    $this->factory = $factory;
                }

                /**
                 * @return \Spryker\Glue\Kernel\AbstractFactory
                 */
                protected function getFactory(): AbstractFactory
                {
                    return $this->factory;
                }
            };
        }

        $this->companyUserCompanyTypeRolesSearchValidatorPlugin->setFactory($this->companyUserCompanyTypeRolesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUserCompanyTypeRolesRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserCompanyTypeRoleSearchValidator')
            ->willReturn($this->companyUserCompanyTypeRolesSearchValidatorMock);

        $this->companyUserCompanyTypeRolesSearchValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->companyUserTransferMock)
            ->willReturn(true);

        $validate = $this->companyUserCompanyTypeRolesSearchValidatorPlugin->validate($this->companyUserTransferMock);
        $this->assertIsBool($validate);
        $this->assertTrue($validate);
    }
}
