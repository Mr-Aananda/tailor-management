<?php

namespace App\Models;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends Model
{
    use HasFactory;
    // add guarded
    protected $guarded = [];
    protected $dates = ['distribute_date'];

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


    /* ==== Scope Start ==== */

    public function scopeWorkerPayableAmount(Builder $query, int $worker_id): Builder
    {
        $worker_salary_query = WorkerSalary::query()
            ->where('worker_salaries.worker_id', $worker_id)
            ->groupBy('worker_salaries.worker_id')
            ->selectRaw('worker_salaries.worker_id, SUM(worker_salaries.amount) as total_paid');

        return $query->where('distributions.worker_id', '=', $worker_id)
            ->where('complete_date', '!=', null)
            ->join('order_details', function ($join) {
                $join->on('distributions.order_details_id', '=', 'order_details.id');
            })
            ->join('items', function ($join) {
                $join->on('order_details.item_id', '=', 'items.id');
            })
            ->join('workers', function ($join) {
                $join->on('distributions.worker_id', '=', 'workers.id');
            })
            ->leftJoinSub($worker_salary_query, 'worker_salary_query', function ($join) {
                $join->on('distributions.worker_id', '=', 'worker_salary_query.worker_id');
            })
            ->groupBy('items.worker_cost')
            ->groupBy('worker_salary_query.total_paid')
            ->groupBy('workers.id')
            ->groupBy('workers.balance')
            ->selectRaw('
        (
            (
                SUM((items.worker_cost * order_details.quantity))
                -
                CASE
                    WHEN worker_salary_query.total_paid IS NULL
                        THEN 0
                    ELSE
                        worker_salary_query.total_paid
                END
            )
            -
            workers.balance
        )
        as
        total_payable
        ');
    }

    public function scopeTotalDistributeAmount(Builder $query, int $worker_id, $from_date, $to_date)
    {
        return $query->where('distributions.worker_id', '=', $worker_id)
            ->whereBetween('distributions.complete_date', [$from_date, $to_date])
            ->join('order_details', function ($join) {
                $join->on('distributions.order_details_id', '=', 'order_details.id');
            })
            ->join('items', function ($join) {
                $join->on('order_details.item_id', '=', 'items.id');
            })
            ->groupBy('items.worker_cost')
            ->selectRaw('
        SUM((items.worker_cost * order_details.quantity))
        as
        total_distribute_amount
        ');
    }

    /* ==== Scope End ==== */



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderDetails(): BelongsTo
    {
        return $this->belongsTo(OrderDetails::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
