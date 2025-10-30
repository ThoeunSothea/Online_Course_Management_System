<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ✅ បន្ថែម Sanctum

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ បន្ថែម HasApiTokens និង Notifiable

    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'role_id', 
        'username', 
        'email', 
        'password', 
        'otp', 
        'otp_expired_at', 
        'email_verified_at'
    ];
    
    protected $hidden = [
        'password', 
        'remember_token', 
        'otp' // ✅ លាក់ OTP
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expired_at' => 'datetime', // ✅ បន្ថែម casting
        'password' => 'hashed' // ✅ Laravel 9+
    ];

    /**
     * Relationship with Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /**
     * Relationship with Profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    /**
     * Relationship with Enrollments as Professor
     */
    public function teachingEnrollments()
    {
        return $this->hasMany(Enrollment::class, 'prof_id', 'user_id');
    }

    /**
     * Relationship with Enrollments as Student
     */
    public function studentEnrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id', 'user_id');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role_id === 1; // Assuming 1 is admin role_id
    }

    /**
     * Check if user is instructor
     */
    public function isInstructor()
    {
        return $this->role_id === 2; // Assuming 2 is instructor role_id
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role_id === 3; // Assuming 3 is student role_id
    }
}