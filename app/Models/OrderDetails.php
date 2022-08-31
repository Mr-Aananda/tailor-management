<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderDetails extends Model
{
    use HasFactory;
    // add guarded
    protected $fillable = [
        'customer_order_id',
        'item_id',
        'image_id',
        'master_id',
        'upper_length',
        'round_body',
        'belly',
        'upper_hip',
        'solder',
        'sleeve',
        'coff',
        'arm',
        'mussle',
        'neck',
        'body_front',
        'belly_front',
        'hip_front',
        'down',
        'straight',
        'lower_length',
        'muhuri',
        'knee',
        'thigh',
        'waist',
        'lower_hip',
        'high',
        'front_down',
        'back_down',
        'fly',
        'front',
        'back',
        'design_id',
        'fitting_id',
        'quantity',
        'status',
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fitting(): BelongsTo
    {
        return $this->belongsTo(Fitting::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customerOrder(): BelongsTo
    {
        return $this->belongsTo(CustomerOrder::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function designs(): BelongsToMany
    {
        return $this->BelongsToMany(Design::class, 'design_order_detail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'master_id','id');
    }

}
