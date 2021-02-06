<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productgallery extends Model
{
    protected $table="productgalleries";
    protected $fillable=['product_id','product_gallery','created_at','updated_at'];

    public static function find_gallery($id)
    {
        return Productgallery::where('product_id',$id)->get();
    }
}
