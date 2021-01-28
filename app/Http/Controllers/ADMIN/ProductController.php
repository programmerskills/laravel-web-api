<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Str;
use App\Category;
use App\Subcategory;
use App\Subchildcategory;
use App\Products;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public $notification=array();
    public function addproduct(Request $req)
    {
        $category=Category::orderBy('catename','ASC')->get();
        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
               'cat_id'=>'required',
               'subcat_id'=>'required',
               'childcat_id'=>'required',
               'product_title'=>'required',
               'reg_price'=>'required',
               'sale_price'=>'required',
               'short_desc'=>'required',
               'long_desc'=>'required',
               'featured_img'=>'required',
            ],
            [
                'cat_id.required'=>'Category field required',
               'subcat_id.required'=>'Subcategory field required',
               'childcat_id.required'=>'Child Category required',
               'product_title.required'=>'Product title required',
               'reg_price.required'=>'Regular price required',
               'sale_price.required'=>'Sale price required',
               'short_desc.required'=>'Short description required',
               'long_desc.required'=>'Long description required',
               'featured_img.required'=>'Featured image required',
            ]);

            $addData=array(
                'cat_id'=>$req->input('cat_id'),
                'subcat_id'=>$req->input('subcat_id'),
                'childcat_id'=>$req->input('childcat_id'),
                'product_title'=>$req->input('product_title'),
                'product_url'=>Str::slug($req->input('product_title'),'-'),
                'reg_price'=>$req->input('reg_price'),
                'sale_price'=>$req->input('sale_price'),
                'short_desc'=>$req->input('short_desc'),
                'long_desc'=>$req->input('long_desc'),
                'featured_img'=>$req->input('featured_img'),
                'created_at'=>date('Y-m-d')  
            );
            if($req->hasFile('featured_img'))
            {
                $imagename=time().'_'.$req->featured_img->getClientOriginalName();
                $req->featured_img->move(public_path('uploads/product/'),$imagename);
                $addData['featured_img']=$imagename;
            }
            if(Products::insert($addData))
            {
                $notification=['success'=>'Successfully save record'];
                return back()->with($notification);
            }
            else
            {
                $notification=['error'=>'Unable to save record'];
                return back()->with($notification);
            }
        }
        else
        {
            return view('admin.product.addproduct',['category'=>$category]);
        }
    }

    public function chidCategoryFromSubcategory(Request $req)
    {
        $cat_id=$req->input('cat_id');
        $subcat_id=$req->input('subcat_id');
        $childcategory=Subchildcategory::where(array('cat_id'=>$cat_id,'subact_id'=>$subcat_id))->get();
        //return $childcategory;
        if($childcategory->count()>0)
        {
            return json_encode(array('status'=>1,'data'=>$childcategory));
        }
        else
        {
            return  json_encode(array('status'=>0));
        }
    }

} //End Main Class................
