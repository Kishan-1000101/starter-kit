<?php

 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;
 
 class CreateShareholdersTable extends Migration {
 
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up() {
         Schema::create('shareholders', function (Blueprint $table) {
             $table->id(); // Auto-increment primary key
             $table->bigInteger('shareholder_id')->nullable()->unsigned();
             $table->bigInteger('tier_id')->unsigned();
             $table->datetime('start');
             $table->datetime('end');
             $table->timestamps();
 
             $table->foreign('tier_id')->references('id')->on('tiers');
         });
     }
 
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down() {
         Schema::dropIfExists('shareholders');
     }
 }