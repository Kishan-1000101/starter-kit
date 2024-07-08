<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencePricebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_pricebooks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pricebook_id')->unsigned();
            $table->bigInteger('reference_id')->unsigned();
            $table->foreign('pricebook_id')->references('id')->on('pricebooks')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_pricebooks');
    }
}

