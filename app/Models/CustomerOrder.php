<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerOrder extends Model
{
    use HasFactory, SoftDeletes;
    // add guarded
    protected $guarded = [];
    protected $dates = ['date', 'delivery_date'];
    protected $appends = ['total_discount', 'grand_total', 'total_due'];


    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETE = 3;
    const STATUS_DELIVERY = 4;


    const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_COMPLETE => 'Complete',
        self::STATUS_DELIVERY => 'Delivered',

    ];

    /**
     * Get withdraw method details.
     *
     * @return string
     */
    public function getCurrentStatusAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Unknown';
    }

    /**
     * Get first payment details.
     */
    // public function getFirstPaidAttribute()
    // {
    //     foreach($this->paymentDetails as $details) {
    //         return $this->date == $details->date ? $details->total_paid : 0;
    //     }
    // }

    /**
     * get all account from bank
     * @return HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }

    /**
     * get all account from bank
     * @return HasMany
     */
    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetails::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


    /**
     * get total discount
     */
    public function getTotalDiscountAttribute()
    {
        return ($this->discount_type == 'percentage') ? ($this->sub_total * $this->discount) / 100 : $this->discount;
    }

    /**
     * get grand total
     */
    public function getGrandTotalAttribute()
    {
        return $this->sub_total - ($this->total_discount  + $this->voucher_amount);
    }

    /**
     * get total due
     */
    public function getTotalDueAttribute()
    {
        return ($this->grand_total - ($this->paymentDetails->sum("total_paid") + $this->paymentDetails->sum("adjustment")));
    }
}
