<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancedSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_salary_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advanced_salary_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->date('date');
            $table->decimal('installment', 10, 2)->default(0.00);
            $table->foreignId('cash_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('payment_type');
            $table->text('note')->nullable();
            $table->boolean('is_paid')->default(0)->comment('0 or 1');
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
        Schema::dropIfExists('advanced_salary_details');
    }
}
