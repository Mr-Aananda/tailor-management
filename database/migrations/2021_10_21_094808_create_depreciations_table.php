<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('years')->comment('approximate use of year');
            $table->decimal('amount')->default(0.00)->comment('fund per year');
            $table->timestamps();
        });

        // details (one to many relation)
        if (Schema::hasTable('depreciations')) {
            Schema::create('depreciation_details', function (Blueprint $table) {
                $table->id();
                $table->date('entry_date');
                $table->foreignId('depreciation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depreciation_details');
        Schema::dropIfExists('depreciations');
    }
}
