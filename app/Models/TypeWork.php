<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWork extends Model
{
    use HasFactory;

    protected $table = 'tbl_type_works';
    protected $primaryKey = 'type_id';
    protected $fillable = ['type'];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'type_id', 'type_id');
    }
}
