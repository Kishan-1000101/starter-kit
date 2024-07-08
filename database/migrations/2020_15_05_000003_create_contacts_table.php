<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tier_id')->nullable()->unsigned();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->char('company_position', 255)->nullable();
            $table->bigInteger('contact_type_id')->nullable()->unsigned();
            $table->char('title', 10)->nullable();
            $table->char('firstname', 255);
            $table->char('lastname', 255);
            $table->char('email', 255)->nullable();
            $table->char('fixed_phone', 50)->nullable();
            $table->char('mobile_phone', 50)->nullable();
            $table->foreignId('address_id')->nullable();
            /*             $table->string('address')->nullable();
            $table->char('address_no', 50)->nullable();
            $table->string('building')->nullable();
            $table->char('zip_code', 50)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->char('latitude', 255)->nullable();
            $table->char('longitude', 255)->nullable(); */
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('tier_id')->references('id')->on('tiers');
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contacts');
    }

}
