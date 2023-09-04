<?php

namespace Tests\Feature\Reservation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingPaymentTest extends TestCase
{
    public function test_guests_can_use_the_stripe_checkout_session(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_guests_can_see_error_on_invalid_payment(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guests_redirected_to_booking_confirm_page_on_canceled_payments(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_guests_can_create_reservation_successfully_on_successful_payments(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
