<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Str;
class SubcategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public $notification=array();

    function addsubcategory(Request $req){
        $category=Category::orderBy('catename','ASC')->get();
        // return $category;
        if($req->isMethod('post')){
            $this->validate($req,[
                'cat_id'=>'required',
                'subcate'=>'required',
                'content'=>'required',
                'image'=>'required',
            ],[
                'cat_id.required'=>'Category field required',
                'subcate.required'=>'Subcategory field required',
                'content.required'=>'Content field required',
                'image.required'=>'Image field required',
                
            ]);
            $addData=array(
                'cat_id'=>$req->input('cat_id'),
                'subcate'=>$req->input('subcate'),
                'slug'=>Str::slug($req->input('subcate'),'-'),
                'content'=>$req->input('content'),
                'created_at'=>date('Y-m-d'),
            );
            if($req->hasFile('image')){
                $imagename=time().'_'.$req->image->getClientOriginalName();
                $req->image->move(public_path('uploads/subcategory/'),$imagename);
                $addData['image']=$imagename;
            }
             if(Subcategory::insert($addData)){
                 $notification=['success'=>'Successfully save subcategory'];
                return back()->with($notification);
             }  
             else{
                $notification=['error'=>'Unable to save subcategory'];
                return back()->with($notification);
             } 
        }
        else{
            return view('admin.subcategory.add',['category'=>$category]);
        }
    }
    
    function managesubcategory()
    {
        $subcategory=Subcategory::orderBy('subcate','ASC')->get();
        $category=Subcategory::with('category')->get();
     // echo "<pre>";print_r($category);die;
        return view('admin.subcategory.manage',['subcategory'=>$subcategory,'category'=>$category]);
    }

    function editsubcategory(Request $req,$id){
        $category=Category::orderBy('catename','ASC')->get();
        $subcatedetail=Subcategory::find($id);

        if($req->isMethod('post')){
            $this->validate($req,[
                'cat_id'=>'required',
                'subcate'=>'required',
                'content'=>'required',
            ],[
                'cat_id.required'=>'Category field required',
                'subcate.required'=>'Subcategory field required',
                'content.required'=>'Content field required',
                
            ]);
            $updateData=array(
                'cat_id'=>$req->input('cat_id'),
                'subcate'=>$req->input('subcate'),
                'slug'=>Str::slug($req->input('subcate'),'-'),
                'content'=>$req->input('content'),
                'updated_at'=>date('Y-m-d'),
            );
            if($req->hasFile('image')){
                $imagename=time().'_'.$req->image->getClientOriginalName();
                $req->image->move(public_path('uploads/subcategory/'),$imagename);
                $updateData['image']=$imagename;
            }
             if(Subcategory::where('id',$id)->update($updateData)){
                 $notification=['success'=>'Successfully update subcategory'];
                return back()->with($notification);
             }  
             else{
                $notification=['error'=>'Unable to update subcategory'];
                return back()->with($notification);
             } 
        }
        else{
            return view('admin.subcategory.edit',['subcatedetail'=>$subcatedetail,'category'=>$category]);
        }
    }
} //end Main Class....
