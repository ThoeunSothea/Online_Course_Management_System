<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_categories';
    protected $primaryKey = 'cate_id';
    protected $fillable = ['cate_name'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'cate_id', 'cate_id');
    }

    public function courseCategories()
    {
        return $this->hasMany(CourseCategory::class, 'cate_id', 'cate_id');
    }
}
