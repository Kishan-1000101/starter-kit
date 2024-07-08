<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricebookTierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricebook_tier', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pricebook_id')->unsigned();
            $table->bigInteger('tier_id')->unsigned();
            $table->dateTime('start');
            $table->dateTime('end')->nullable();

            $table->foreign('pricebook_id')->references('id')->on('pricebooks')->onDelete('cascade');
            $table->foreign('tier_id')->references('id')->on('tiers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricebook_tier');
    }
}

