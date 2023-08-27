<?php

namespace App\Models;

use App\Models\Coupon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'pay_type_id',
        'coupon_id',
        'total_paid_mmk',
        'preferred_currency',
    ];

    /**
     * Get the total revenue (sum of total_amount_mmk) for today.
     *
     * @param Builder $query
     * @return float
     */
    public function scopeTotalRevenueToday($query)
    {
        $today = date('Y-m-d');
        return $query->whereDate('created_at', $today)->sum('total_paid_mmk');
    }


    public function getFormattedTotalAttribute()
    {
        $total = $this->preferred_currency == "MMK" ? $this->total_paid_mmk : $this->total_paid_usd;
        return $this->unit . $total;
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function getUnitAttribute()
    {
        return $this->preferred_currency == "MMK" ? "Ks." : '$';
    }
    public function getTotalPaidUsdAttribute()
    {
        return $this->total_paid_mmk / 2000;
    }
}
