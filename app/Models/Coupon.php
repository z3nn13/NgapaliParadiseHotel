<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code',
        'coupon_name',
        'uses',
        'max_uses',
        'discount_percentage',
        'start_date',
        'expire_date',
        'is_expired',
    ];

    /**
     * Check if the coupon is valid.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        $now = Carbon::now();

        return !$this->is_expired
            && $this->start_date <= $now
            && $this->expire_date >= $now
            && $this->uses < $this->max_uses;
    }

    /*
     * Calculate the discount in user's currency.
     *
     */
    public function calculateDiscount($subtotal, $userCurrency)
    {
        $discountPercentage = min($this->discount_percentage, 100); // Ensure the percentage is not greater than 100%
        $discountInUserCurrency = $subtotal * ($discountPercentage / 100);
        $roundedDiscount = $this->roundDiscount($discountInUserCurrency, $userCurrency);
        return min($roundedDiscount, $subtotal);
    }

    /*
     * Apply the discount to the subtotal.
     *
     */
    public function applyCoupon($subtotal, $userCurrency)
    {
        if ($this->isValid()) {
            $discountAmount = $this->calculateDiscount($subtotal, $userCurrency);
            return max(0, $subtotal - $discountAmount);
        }

        return $subtotal;
    }

    public function useCoupon()
    {
        $this->uses++;
        $this->save();
    }

    /*
     * Round the discount amount based on user's currency.
     *
     */
    private function roundDiscount($amount, $userCurrency)
    {
        if ($userCurrency === 'USD') {
            return round($amount, 2);
        } elseif ($userCurrency === 'MMK') {
            return round($amount);
        }

        return $amount; // Default: no rounding
    }
}
