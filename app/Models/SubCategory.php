<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table="db_subcategory";

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function child_category(){
        return $this->hasMany(ChildCategory::class,'subcategory_id','id');
    }
}
