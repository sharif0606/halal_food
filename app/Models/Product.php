<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="db_items";

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function sub_category(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function child_category(){
        return $this->belongsTo(ChildCategory::class,'childcategory_id','id');
    }
}
