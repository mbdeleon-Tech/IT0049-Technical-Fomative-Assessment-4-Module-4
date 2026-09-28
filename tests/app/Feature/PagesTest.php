<?php

namespace Tests\App\Feature;

use CodeIgniter\Test\CIUnitTestCase;

class PagesTest extends CIUnitTestCase
{
    public function testControllersUseModelsInsteadOfStaticArrays(): void
    {
        $customers = file_get_contents(APPPATH . 'Controllers/Customers.php');
        $users = file_get_contents(APPPATH . 'Controllers/Users.php');

        $this->assertStringContainsString('CustomerModel', $customers);
        $this->assertStringContainsString('findAll()', $customers);
        $this->assertStringContainsString('UserModel', $users);
        $this->assertStringContainsString('findAll()', $users);
    }

    public function testRequiredModelsMapToDatabaseTables(): void
    {
        $customerModel = file_get_contents(APPPATH . 'Models/CustomerModel.php');
        $userModel = file_get_contents(APPPATH . 'Models/UserModel.php');

        $this->assertStringContainsString("protected \$table = 'customers'", $customerModel);
        $this->assertStringContainsString("protected \$table = 'users'", $userModel);
        $this->assertStringContainsString('full_name', $customerModel);
        $this->assertStringContainsString('username', $userModel);
    }

    public function testDatabaseExportContainsRequiredSchemaAndRecords(): void
    {
        $sql = file_get_contents(ROOTPATH . 'database/tfa4_pos.sql');

        $this->assertStringContainsString('CREATE TABLE `customers`', $sql);
        $this->assertStringContainsString('CREATE TABLE `users`', $sql);
        $this->assertStringContainsString('Alyssa Santos', $sql);
        $this->assertStringContainsString('support.nica', $sql);
        $this->assertStringContainsString('`password` VARCHAR(255) NOT NULL', $sql);
        $this->assertStringContainsString('$2y$10$', $sql);
    }

    public function testViewsStillRenderDatabaseFields(): void
    {
        $customers = file_get_contents(APPPATH . 'Views/customers/index.php');
        $users = file_get_contents(APPPATH . 'Views/users/index.php');

        $this->assertStringContainsString("\$customer['email']", $customers);
        $this->assertStringContainsString("\$user['username']", $users);
        $this->assertStringContainsString("\$user['created_at']", $users);
    }
}
