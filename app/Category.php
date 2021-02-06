<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $table = 'categories';
    protected $fillable=[
        'catename','cateslug','cateimage','content','created_at'
    ];
    // public static function update($updateData,$id)
    // {
    //     return Category::where(array('id'=>$id))->update($updateData);
    // }
    public static function check($catename){
        return Category::where('catename',$catename)->first();
    }

    public static function allcategory()
    {
        return Category::orderBy('catename','ASC')->get();
    }

}
