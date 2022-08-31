<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('expense_category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('expense_sub_category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('amount', 10, 2)->default(0);
            $table->foreignId('cash_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('payment_type');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
