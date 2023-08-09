<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $table="db_childcategory";

    public function sub_category(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
}
