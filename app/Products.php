<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';
    protected $fillable=['cat_id','subcat_id','childcat_id','product_title','reg_price','sale_price','product_url','short_desc','long_desc','featured_img','status','created_at','updated_at'];
}
