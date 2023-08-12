<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\RoomDeal;
use Stripe\StripeClient;

class ReservationPaymentService
{
    /*
     * Process the payment using Stripe checkout.
     *
     */

    public function processPayment(array $roomsBooked, array $billingData): string
    {
        $stripe = new StripeClient(config('stripe.sk'));
        $currency = $billingData['currency'];
        $coupon = $this->checkCoupon($billingData);


        $lineItems = $this->buildLineItems($roomsBooked, $currency, $coupon);

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

    /*
     * Check coupon from billing data.
     *
     */
    private function checkCoupon(array $billingData): ?Coupon
    {
        $couponData = isset($billingData['coupon']) ? json_decode($billingData['coupon']) : null;

        if ($couponData) {
            $coupon = new Coupon();
            $coupon->fill((array)$couponData); // Fill the model attributes with JSON data
            return $coupon;
        }

        return null;
    }

    /*
     * Build line items for Stripe checkout.
     *
     */
    private function buildLineItems(array $roomsBooked, string $currency, ?Coupon $coupon): array
    {
        $lineItems = [];
        foreach ($roomsBooked as $room) {
            $roomType = $room['roomType'];
            $roomDeal = $room['roomDeal'];

            $price = $this->getRoomPrice($roomDeal, $currency);
            if ($coupon) {
                $price = $this->applyCoupon($price, $coupon, $currency);
            }
            $unitAmount = $price * 100;

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



    /*
     * Retrieve a coupon by its code and check its validity.
     *
     */
    public function retrieveCoupon(string $couponCode): ?Coupon
    {
        $couponCode = strtoupper(trim($couponCode));
        if (!$couponCode) {
            return null;
        }

        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        return $coupon && $coupon->isValid() ? $coupon : null;
    }



    /*
     * Apply a coupon to a given price in the preferred currency.
     *
     */
    public function applyCoupon($price, ?Coupon $coupon, string $preferredCurrency)
    {
        if ($coupon) {
            return $coupon->applyCoupon($price, $preferredCurrency);
        }

        return $price;
    }


    public function calculateSubTotal($reservationRooms, $preferredCurrency)
    {
        return collect($reservationRooms)
            ->map(fn ($room) => $this->getRoomPrice(
                $room["roomDeal"],
                $preferredCurrency
            ))
            ->sum();
    }

    /*
     * Get the price of a room deal in the preferred currency.
     *
     */
    public function getRoomPrice(RoomDeal $roomDeal, string $preferredCurrency): float
    {
        return $preferredCurrency === "MMK" ? $roomDeal->deal_mmk : $roomDeal->deal_usd();
    }
}
