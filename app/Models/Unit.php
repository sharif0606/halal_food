<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table="db_units";
    public function product(){
        return $this->hasMany(Product::class,'unit_id','id');
    }
}
