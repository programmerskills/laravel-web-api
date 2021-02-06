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
use App\Productgallery;
use DB;

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
            if($id=Products::insertGetId($addData))
            {   
                if($req->hasFile('product_gallery'))
                {   $pro_gallery=array();
                    foreach($req->file('product_gallery') as $file)
                    {
                        $filename=time().'_'.$file->getClientOriginalName();
                        $file->move(public_path('uploads/productgallery/'),$filename);
                        array_push($pro_gallery,array('product_id'=>$id,'product_gallery'=>$filename,'created_at'=>date('Y-m-d')));
                    }
                }
                if(Productgallery::insert($pro_gallery))
                {
                    $notification=['success'=>'Successfully save record'];
                    return back()->with($notification);
                }
                
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

    public function manageproduct()
    {
        //return "test";
        $products= Products::allproduct();
        $category=Products::with('category')->get();
        $subcategory=Products::with('subcategory')->get();
        $childcategory=Products::with('childcategory')->get();
        return view('admin.product.manageproduct',[
            'products'=>$products,
            'category'=>$category,
            'subcategory'=>$subcategory,
            'childcategory'=>$childcategory
        ]);
    }

    public function editproduct(Request $req, $id)
    {

        if($req->isMethod('post'))
        {
            // return $req->all();
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
            ]);

            $updateData=array(
                'cat_id'=>$req->input('cat_id'),
                'subcat_id'=>$req->input('subcat_id'),
                'childcat_id'=>$req->input('childcat_id'),
                'product_title'=>$req->input('product_title'),
                'product_url'=>Str::slug($req->input('product_title'),'-'),
                'reg_price'=>$req->input('reg_price'),
                'sale_price'=>$req->input('sale_price'),
                'short_desc'=>$req->input('short_desc'),
                'long_desc'=>$req->input('long_desc'),
                'updated_at'=>date('Y-m-d')  
            );
            if($req->hasFile('featured_img'))
            {
                $imagename=time().'_'.$req->featured_img->getClientOriginalName();
                $req->featured_img->move(public_path('uploads/product/'),$imagename);
                $updateData['featured_img']=$imagename;
            }
            
            if(Products::where('id',$id)->update($updateData))
            {
                if($req->hasFile('product_gallery'))
                {   $pro_gallery=array();
                    $gal_id=$req->gal_id;
                    
                    $filecount= count($req->product_gallery);
                    for($i=0;$i<$filecount;$i++)
                    {
                       //$gal_id[$i]+3;
                       
                        $filename=time().'_'.$req->product_gallery[$i]->getClientOriginalName();
                        $req->product_gallery[$i]->move(public_path('uploads/productgallery/'),$filename);
                        if($gal_id[$i]>0)
                        {
                            DB::table('productgalleries')->where(['id'=>$gal_id[$i]])->update(['product_id'=>$id,'product_gallery'=>$filename,'updated_at'=>date('Y-m-d')]);
                        }
                        if($gal_id[$i]==0)
                        {
                            DB::table('productgalleries')->insert(['product_id'=>$id,'product_gallery'=>$filename,'updated_at'=>date('Y-m-d')]);
                        }
                        
             
            
            
                        // array_push($pro_gallery,array('product_id'=>$id,'product_gallery'=>$filename,'created_at'=>date('Y-m-d')));
                       
                    }
                }
                // if(Productgallery::insert($pro_gallery))
                // {
                //     $notification=['success'=>'Successfully save record'];
                //     return back()->with($notification);
                // }

                $notification=['success'=>'Successfully update record'];
                return back()->with($notification);
            }
            else
            {
                $notification=['error'=>'Unable to update record'];
                return back()->with($notification);
            }
        }

        $details=Products::find($id);
        $category=Category::allcategory();
        $subcategory=Subcategory::where('cat_id',$details->cat_id)->get();
        $childcategory=Subchildcategory::where(array('cat_id'=>$details->cat_id,'subact_id'=>$details->subcat_id))->get();
        $productgallery=Productgallery::find_gallery($id);
         return view('admin.product.editproduct',[
             'details'=>$details,
             'category'=>$category,
             'subcategory'=>$subcategory,
             'childcategory'=>$childcategory,
             'productgallery'=>$productgallery
             ]);
        
    }

} //End Main Class................
