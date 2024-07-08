<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->char('lxn_id', 10)->nullable();
            $table->string('street')->nullable();
            $table->char('street_no', 10)->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->string('district')->nullable();
            $table->char('zip_code', 50);
            $table->string('city');
            $table->char('country_alpha3', 3);
            $table->bigInteger('latitude')->nullable();
            $table->bigInteger('longitude')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['lxn_id', 'country_alpha3']);
            $table->foreign('country_alpha3')->references('alpha3')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
