<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // journal  
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('contact_id')->comment('Spender')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // details 
        if (Schema::hasTable('journals')) {
            // one to many relation
            Schema::create('journal_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('journal_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreignId('account_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->decimal('amount', 12, 2)->default(0.00);
                $table->boolean('is_debit');
                $table->boolean('is_credit');
                $table->string('pair_key');
                $table->timestamps();
            });

            // many to many polymorphic relation
            Schema::create('journalables', function (Blueprint $table) {
                $table->id();
                $table->foreignId('journal_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->nullableMorphs('journalable');
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
        Schema::dropIfExists('journalables');
        Schema::dropIfExists('journal_details');
        Schema::dropIfExists('journals');
    }
}
