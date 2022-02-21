<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testRewardsPage()
    {
        $response = $this->get('/rewards');

        $response->assertStatus(302);
    }

    public function testRewardClaimPage()
    {
        $response = $this->get('/reward/1/claim');

        $response->assertStatus(302);
    }


    public function testAdminPanel()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    public function testScoreOperationsPage()
    {
        $response = $this->get('/score-operations');

        $response->assertStatus(401);
    }
}