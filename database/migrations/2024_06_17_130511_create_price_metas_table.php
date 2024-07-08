<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_metas', function (Blueprint $table) {
            $table->id();
            $table->char('name', 20);
            $table->char('full_name', 100)->nullable();
            $table->integer('display_order')->default(3);
            $table->char('devise_symbole', 1)->nullable();
            $table->char('devise_name', 3)->nullable();
            $table->decimal('devise_rate', 10, 2)->nullable();
            $table->json('devise_rule')->nullable();
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
        Schema::dropIfExists('price_metas');
    }
}
