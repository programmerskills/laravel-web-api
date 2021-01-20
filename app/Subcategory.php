<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table="subcategories";
    protected $fillable=['cat_id','subcate','image','content','status','created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }
    public function category1()
    {
        return $this->hasOne(Category::class,'id','cat_id');
    }
}
