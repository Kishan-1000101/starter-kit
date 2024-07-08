<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50);
            $table->char('display_name', 255);
            $table->char('type', 50)->default('string');
            $table->char('input_type', 20)->default('text');
            $table->json('values')->nullable();
            $table->string('rules')->nullable();
            $table->boolean('disabled')->nullable();
            $table->char('prefix', 10)->nullable();
            $table->char('suffix', 10)->nullable();
            $table->char('groupingKey', 50)->default("*");
            $table->foreignId('parent')->nullable();

            $table->foreign('parent')->references('id')->on('items');

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
        Schema::dropIfExists('items');
    }
}
