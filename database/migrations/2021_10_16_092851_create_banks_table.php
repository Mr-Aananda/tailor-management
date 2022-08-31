<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // banks
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // bank-accounts details
        if (Schema::hasTable('banks')) {
            Schema::create('bank_accounts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('bank_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('account_name');
                $table->string('account_number', 45);
                $table->string('branch');
                $table->decimal('balance', 12, 2)->default(0.00);
                $table->longText('note')->nullable();
                $table->SoftDeletes();
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
        // Bank account
        Schema::dropIfExists('bank_accounts');

        // Bank
        Schema::dropIfExists('banks');
    }
}
