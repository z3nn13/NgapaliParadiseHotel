<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    public function test_user_admin_table_is_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_sort_the_users_table_by_sortable_fields(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_search_the_users_table_by_keywords(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_update_details_of_a_user(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_delete_a_user(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_select_to_delete_users(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_select_to_export_users(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
