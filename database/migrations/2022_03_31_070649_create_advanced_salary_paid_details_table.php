<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancedSalaryPaidDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_salary_paid_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advanced_salary_details_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('installment_pay', 10, 2)->default(0.00);
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
        Schema::dropIfExists('advanced_salary_paid_details');
    }
}
