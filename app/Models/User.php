<?php


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_users';       // ✅ custom table
    protected $primaryKey = 'user_id';    // ✅ custom primary key

    protected $fillable = [
        'role_id',
        'username',
        'email',
        'password',
        'otp',
        'otp_expired_at',
        'email_verified_at',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expired_at' => 'datetime',
        'password' => 'hashed'
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    // Role helpers
    public function isAdmin(): bool
    {
        return (int)$this->role_id === 1;
    }

    public function isInstructor(): bool
    {
        return (int)$this->role_id === 2;
    }

    public function isStudent(): bool
    {
        return (int)$this->role_id === 3;
    }
}
