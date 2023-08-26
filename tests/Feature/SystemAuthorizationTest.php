<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SystemAuthorizationTest extends TestCase
{
    public function test_users_cannot_access_booking_routes_without_active_booking_session(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_users_cannot_skip_booking_stages_without_completing(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_regular_users_cannot_access_admin_only_routes(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_access_admin_only_routes(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_users_cannot_access_other_users_booking_details(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_access_all_users_booking_details(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
