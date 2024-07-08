<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('enabled')->default(false);
            $table->string('notification')->nullable();
            $table->char('userable_type', 255)->nullable();
            $table->bigInteger('userable_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->string('authentication_provider')->default('local');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('current_team_id')->nullable();
            $table->boolean('is_super_admin')->default(false);
            $table->string('comment')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
