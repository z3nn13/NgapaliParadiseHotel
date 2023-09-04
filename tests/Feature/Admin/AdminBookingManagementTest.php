<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminBookingManagementTest extends TestCase
{
    public function test_admins_can_see_the_booking_table(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_sort_the_booking_table_by_sortable_fields(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_search_through_the_booking_table(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admins_can_view_a_booking_record(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_delete_a_booking_record(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_admins_can_change_the_status_of_a_booking_record(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
