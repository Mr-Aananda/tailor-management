<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // contact 
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('organigation_name');
            $table->string('contact_person_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nid')->nullable();
            $table->string('email_address')->nullable();
            $table->decimal('opening_balance', 12, 2)->default(0.00)->comment('Positive(+) balance payable and negative(-) is receivable.');
            $table->decimal('current_balance', 12, 2)->default(0.00)->comment('Positive(+) balance payable and negative(-) is receivable.');
            $table->decimal('credit_limit', 12, 2)->default(0.00);
            $table->string('contact_type');
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // phone
        if (Schema::hasTable('contacts')) {
            Schema::create('contact_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('contact_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('mobile_number');
                $table->boolean('is_primary');
                $table->timestamps();
            });
        }

        // address
        if (Schema::hasTable('contacts')) {
            Schema::create('contact_addresses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('contact_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->text('street')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('union')->nullable();
                $table->string('upazila')->nullable();
                $table->string('district')->nullable();
                $table->string('division')->nullable();
                $table->string('address_type');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contact_addresses');
        Schema::dropIfExists('contact_details');
        Schema::dropIfExists('contacts');
    }
}
