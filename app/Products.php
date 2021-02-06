<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';
    protected $fillable=['cat_id','subcat_id','childcat_id','product_title','reg_price','sale_price','product_url','short_desc','long_desc','featured_img','status','created_at','updated_at'];

    public static function allproduct()
    {
        return Products::orderBy('product_title','ASC')->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcat_id','id');
    }

    public function childcategory()
    {
        return $this->belongsTo(Subchildcategory::class,'childcat_id','id');
    }
} //End main Class
