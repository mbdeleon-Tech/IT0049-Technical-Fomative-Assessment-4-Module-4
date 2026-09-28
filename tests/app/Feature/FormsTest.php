<?php
namespace Tests\App\Feature;
use CodeIgniter\Test\CIUnitTestCase;
class FormsTest extends CIUnitTestCase
{
    public function testRequiredFeaturesExist(): void
    {
        $routes = file_get_contents(APPPATH . 'Config/Routes.php');
        $customers = file_get_contents(APPPATH . 'Controllers/Customers.php');
        $users = file_get_contents(APPPATH . 'Controllers/Users.php');
        $view = file_get_contents(APPPATH . 'Views/users/index.php');
        $auth = file_get_contents(APPPATH . 'Controllers/Auth.php');
        $this->assertStringContainsString('customers/new', $routes);
        $this->assertStringContainsString('users/(:num)/edit', $routes);
        $this->assertStringContainsString('valid_email', $customers);
        $this->assertStringContainsString('withInput()', $customers);
        $this->assertStringContainsString('is_unique[users.username]', $users);
        $this->assertStringContainsString('max_size[avatar,2048]', $users);
        $this->assertStringContainsString('fit(160, 160', $users);
        $this->assertStringContainsString('password_hash(', $users);
        $this->assertStringContainsString('password_verify(', $auth);
        $this->assertStringContainsString("['filter' => 'auth']", $routes);
        $this->assertStringContainsString('placeholder.svg', $view);
        $this->assertFileExists(FCPATH . 'uploads/placeholder.svg');
    }
}
