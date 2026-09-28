<?php

namespace Tests\App\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class AuthenticationTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testLoginPageIsPublic(): void
    {
        $result = $this->get('/login');

        $result->assertOK();
        $result->assertSee('Sign in to Northstar POS');
    }

    public function testProtectedPageRedirectsLoggedOutVisitor(): void
    {
        $result = $this->get('/customers/new');

        $result->assertRedirectTo('/login');
    }

    public function testLoggedInUserCanReachProtectedPage(): void
    {
        $result = $this->withSession([
            'userId' => 1,
            'username' => 'admin.marc',
            'fullName' => 'Marco De Leon',
            'isLoggedIn' => true,
        ])->get('/customers/new');

        $result->assertOK();
        $result->assertSee('New Customer');
    }

    public function testAuthenticationComponentsAreRegistered(): void
    {
        $routes = file_get_contents(APPPATH . 'Config/Routes.php');
        $filters = file_get_contents(APPPATH . 'Config/Filters.php');
        $filter = file_get_contents(APPPATH . 'Filters/AuthFilter.php');

        $this->assertStringContainsString("post('logout'", $routes);
        $this->assertStringContainsString("'auth'", $filters);
        $this->assertStringContainsString("session()->get('isLoggedIn')", $filter);
    }
}
