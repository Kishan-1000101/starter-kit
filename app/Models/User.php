<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles; // Add this line

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles; // Add HasRoles trait

    protected $fillable = [
        'login',
        'password',
        'email',
        'enabled',
        'notification',
        'userable_type',
        'userable_id',
        'email_verified_at',
        'remember_token',
        'google_id',
        'authentication_provider',
        'profile_photo_path',
        'google_id',
        'current_team_id',
        'is_super_admin',
        'comment',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
