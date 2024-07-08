<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segmentation_id')->nullable();
            $table->foreignId('tier_id')->nullable()->index;
            $table->foreignId('tier_type_id'); //supliers ou customers ou salarié ou autre
            $table->char('tierable_type', 255);
            $table->foreignId('tierable_id');
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('segmentation_id')->references('id')->on('segmentations');
            $table->foreign('tier_type_id')->references('id')->on('tier_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tiers');
    }

}
