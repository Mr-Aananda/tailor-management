<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Template 
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('particular');
            $table->boolean('is_depreciable')->default(0);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Template details 
        if (Schema::hasTable('templates')) {
            Schema::create('template_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('template_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('account_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->boolean('is_debitable')->default(0);
                $table->boolean('is_creditable')->default(0);
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
        // Template details
        Schema::dropIfExists('template_details');

        // Template 
        Schema::dropIfExists('templates');
    }
}
