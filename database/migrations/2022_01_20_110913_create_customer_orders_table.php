<?php

use App\Models\CustomerOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date');
            $table->string('order_no');
            $table->date('delivery_date');
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->string('discount_type')->nullable();
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('voucher_amount', 12, 2)->default(0);
            $table->decimal('fabric_billt', 12, 2)->default(0);
            $table->decimal('fabric_paid', 12, 2)->default(0);
            $table->foreignId("user_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('status')->default(CustomerOrder::STATUS_PENDING);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_orders');
    }
}
