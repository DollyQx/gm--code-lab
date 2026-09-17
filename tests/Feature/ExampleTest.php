<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test root url redirects to login portal.
     */
    public function test_the_application_redirects_root_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }
}
