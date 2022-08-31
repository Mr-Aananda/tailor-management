<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_salaries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('worker_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('amount', 10, 2)->default(0);
            $table->foreignId('cash_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('payment_type');
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('bonus_amount', 10, 2)->default(0);
            $table->date('form_date')->nullable();
            $table->date('to_date')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('worker_salaries');
    }
}
