<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tbl_roles';     // តារាងដែលអ្នកប្រើ
    protected $primaryKey = 'role_id';  // Primary key ក្នុង table

    protected $fillable = [
        'role_name',
        'created_at',
        'updated_at'
    ];

    // Relationship (១ Role មាន Users ច្រើន)
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
