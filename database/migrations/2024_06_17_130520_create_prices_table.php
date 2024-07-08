<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('segmentation_id')->unsigned()->nullable();
            $table->decimal('base_amount', 10, 2)->default(0.00);
            $table->bigInteger('price_meta_id')->unsigned()->notNullable();
            $table->foreign('price_meta_id')->references('id')->on('price_metas');
            $table->foreign('segmentation_id')->references('id')->on('segmentations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
