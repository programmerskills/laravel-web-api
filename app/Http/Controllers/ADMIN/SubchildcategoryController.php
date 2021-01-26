<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use Validator;
use App\Category;
use App\Subcategory;
use App\Subchildcategory;
class SubchildcategoryController extends Controller
{
    
   public function __construct()
    {
        $this->middleware('auth');
    }
    public $notification=array();
    function addchildcategory(Request $req)
    {   
        $category=Category::orderBy('catename','ASC')->get();
        if($req->isMethod('post'))
        {
            //return $req->all();
            $this->validate($req,
            [
                'cat_id'=>'required',
                'subact_id'=>'required',
                'subchild_name'=>'required',
                'image'=>'required',
                'content'=>'required',
            ],
            [
                'cat_id.required'=>'Select Category',
                'subact_id.required'=>'Select Subcategory',
                'subchild_name.required'=>'Subchildcategory name required',
                'image.required'=>'Image required',
                'content.required'=>'Content required',
            ]);
            $addData=array(
                'cat_id'=>$req->input('cat_id'),
                'subact_id'=>$req->input('subact_id'),
                'subchild_name'=>$req->input('subchild_name'),
                'url'=>Str::slug($req->input('subchild_name'),'-'),
                'content'=>$req->input('content'),
                'created_at'=>date('Y-m-d')
            );
            if($req->hasFile('image'))
            {
                $imagname=time().'_'.$req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads/subchild/'),$imagname);
                $addData['image']=$imagname;
            }
            if(Subchildcategory::insert($addData))
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
            return view('admin.subchildcategory.add',['category'=>$category]);
        }
    }

    function subcategoryFromCategory(Request $req)
    {
        $cat_id=$req->input('cat_id');
        $subcategory=Subcategory::where('cat_id',$cat_id)->get();
        //return $subcategory;
        if($subcategory->count()>0)
        {
            return json_encode(array('status'=>1,'data'=>$subcategory));
        }
        else
        {
            return  json_encode(array('status'=>0));
        }
    }
    function managechildcategory()
    {
        $subchildcategories=Subchildcategory::orderBy('subchild_name','ASC')->get();
        $category=Subchildcategory::with('category')->get();
        $subcategory=Subchildcategory::with('subcategory')->get();
        return view('admin.subchildcategory.manage',[
            'subchildcategories'=>$subchildcategories,
            'category'=>$category,
            'subcategory'=>$subcategory
        ]);
    }

    function editchildcategory(Request $req, $id)
    {   
        $details=Subchildcategory::find($id);
        $category=Category::orderBy('catename','ASC')->get();
        $cat_id=$details['cat_id'];
        $subcategory=Subcategory::where('cat_id',$cat_id)->get();
        
        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
                'cat_id'=>'required',
                'subact_id'=>'required',
                'subchild_name'=>'required',
                'content'=>'required',
            ],
            [
                'cat_id.required'=>'Select Category',
                'subact_id.required'=>'Select Subcategory',
                'subchild_name.required'=>'Subchildcategory name required',
                'content.required'=>'Content required',
            ]);
            $updateData=array(
                'cat_id'=>$req->input('cat_id'),
                'subact_id'=>$req->input('subact_id'),
                'subchild_name'=>$req->input('subchild_name'),
                'url'=>Str::slug($req->input('subchild_name'),'-'),
                'content'=>$req->input('content'),
                'updated_at'=>date('Y-m-d')
            );
            if($req->hasFile('image'))
            {
                $imagname=time().'_'.$req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads/subchild/'),$imagname);
                $updateData['image']=$imagname;
            }
            if(Subchildcategory::where('id',$id)->update($updateData))
            {
                $notification=['success'=>'Successfully updated record'];
                return back()->with($notification);
            }
            else
            {
                $notification=['error'=>'Unable to update record'];
                return back()->with($notification);
            }
        }
        else
        {
            return view('admin.subchildcategory.edit',[
                'details'=>$details,
                'category'=>$category,
                'subcategory'=>$subcategory
                ]);
        }
       
       
    }
} //End main class
