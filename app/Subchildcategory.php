<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subchildcategory extends Model
{
    protected $table="subchildcategories";
    protected $fillable=['cat_id','subact_id','subchild_name','url','image','content','created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subact_id','id');
    }
}
