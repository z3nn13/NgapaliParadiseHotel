<?php

namespace App\Services;
// app/Services/ReservationPaymentService.php
/**
 * Class ReservationPaymentService
 * @package App\Services
 */

use Stripe\StripeClient;
use App\Models\Coupon;

class ReservationPaymentService
{
    /**
     * Process the payment using Stripe checkout.
     *
     * @param array     $roomsBooked    Array of booked rooms.
     * @param array     $billingData    Array containing billing information like currency, email, and optional couponID.
     *
     * @return string                   The URL to redirect the customer to complete the payment.
     */

    public function processPayment(array $roomsBooked, array $billingData): string
    {
        $stripe = new StripeClient(config('stripe.sk'));
        $currency = $billingData['currency'];
        $couponID = $billingData['couponID'] ?? null;
        $lineItems = $this->buildLineItems($roomsBooked, $currency, $couponID);

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'customer_email' => $billingData['email'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('booking.success'),
            'cancel_url' => route('booking.confirm'),
        ]);

        return $session->url;
    }


    /**
     * Build line items for Stripe checkout.
     *
     * @param array     $roomsBooked    Array of booked rooms.
     * @param string    $currency       The currency code (e.g., "USD" or "MMK").
     * @param int|null  $couponID       The coupon ID, if available.
     *
     * @return array                    An array of line items.
     */
    private function buildLineItems(array $roomsBooked, string $currency, ?int $couponID): array
    {
        $lineItems = [];
        foreach ($roomsBooked as $room) {
            $roomType = $room['roomType'];
            $roomDeal = $room['roomDeal'];

            $price = $currency == "USD" ? $roomDeal->deal_usd : $roomDeal->deal_mmk;
            $unitAmount = $price * 100;

            if ($couponID) {
                $price = $this->applyCouponDiscount($price, $couponID);
            }

            $lineItems[] = [
                'quantity' => 1,
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $unitAmount,
                    'product_data' => [
                        'name' => $roomType->room_type_name,
                        'description' => $roomDeal->deal_name,
                    ],
                ],
            ];
        }

        return $lineItems;
    }


    /**
     * Apply Coupon Discount to Price.
     *
     * @param float     $price  .
     * @param int|null  $couponID       The coupon ID, if available.
     *
     * @return float                    An array of line items.
     */
    private function applyCouponDiscount(float $price, int $couponID): float
    {
        $coupon = Coupon::find($couponID);

        if (!$coupon) {
            return $price;
        }

        return $price - $price * $coupon->discount_amount;
    }
}
