<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tier_id')->nullable()->unsigned();
            $table->char('name', 255);
            $table->char('legal_form', 20)->nullable();
            $table->char('registration_number', 255)->nullable();
            $table->char('vat_number', 255)->nullable();
            $table->foreignId('address_id')->nullable();
/*             $table->string('address')->nullable();
            $table->char('address_no', 50)->nullable();
            $table->string('building')->nullable();
            $table->char('zip_code', 50)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->char('latitude', 255)->nullable();
            $table->char('longitude', 255)->nullable(); */
            $table->char('fixed_phone', 50)->nullable();
            $table->char('email', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('tier_id')->references('id')->on('tiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
