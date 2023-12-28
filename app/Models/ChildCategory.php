<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $fillable =  [
        'name', 'status', 'slug', 'category_id','sub_category_id'
    ];

    public function category()
    {
       return  $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
       return  $this->belongsTo(SubCategory::class);
    }

    // public function product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
