<?php

use App\Models\OrderDetails;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('image_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("master_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('upper_length')->nullable();
            $table->string('round_body')->nullable();
            $table->string('belly')->nullable();
            $table->string('upper_hip')->nullable();
            $table->string('solder')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('coff')->nullable();
            $table->string('arm')->nullable();
            $table->string('mussle')->nullable();
            $table->string('neck')->nullable();
            $table->string('body_front')->nullable();
            $table->string('belly_front')->nullable();
            $table->string('hip_front')->nullable();
            $table->string('down')->nullable();
            $table->string('straight')->nullable();
            //Lower part
            $table->string('lower_length')->nullable();
            $table->string('muhuri')->nullable();
            $table->string('knee')->nullable();
            $table->string('thigh')->nullable();
            $table->string('waist')->nullable();
            $table->string('lower_hip')->nullable();
            $table->string('high')->nullable();
            $table->string('front_down')->nullable();
            $table->string('back_down')->nullable();
            $table->string('fly')->nullable();
            $table->string('front')->nullable();
            $table->string('back')->nullable();
            $table->foreignId('fitting_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('quantity')->default(1);
            $table->tinyInteger('status')->default(OrderDetails::STATUS_PENDING);
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
        Schema::dropIfExists('order_details');
    }
}
