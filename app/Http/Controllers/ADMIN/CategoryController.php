<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public $notification=array();
    function addcategory(Request $request)
    {   
        if($request->isMethod('post'))
        {
            $this->validate($request,
            [    
            'catename'=>'required|unique:categories,catename',
            'content'=>'required',
            'cateimage'=>'required',
            ],[
                'catename.required'=>'Category name required',
                'catename.unqiue'=>'Already taken category name',
                'content.required'=>'Category content required',
                'cateimage.required'=>'Category image required'
            ]);
        //return $request()->all();
        $addData=array(
            'catename'=>$request->input('catename'),
            'cateslug'=>Str::slug($request->input('catename'),'-'),
            'content'=>$request->input('content'),
            'created_at'=>date('Y-m-d')
        );
        //return $request->hasFile('cateimage');
        if($request->hasFile('cateimage'))
        {
            $imagename=time().'_'.$request->cateimage->getClientOriginalName();
            // echo $imagename;die;
            $request->cateimage->move(public_path('uploads/category/'),$imagename);
            $addData['cateimage']=$imagename;
        }
        // return $addData;
        if(Category::insert($addData))
        {
            $notification=['success'=>'Added Category Records'];
            return back()->with($notification);
        }
        else
        {
            $notification=['error'=>'Unable to Add Category'];
            return back()->with($notification);
        }
        }
        else{
            return view('admin.category.add');
        }
          
    }

    function managecategory()
    {
        $category=Category::orderBy('catename','ASC')->get();
        // return $category;
        return view('admin.category.manage',['category'=>$category]);
    }

    function editcategory(Request $request, $id){
        if($request->isMethod('post')){
            // $catename=$request->input('catename');
            // $exist=Category::checkexisting($catename);
           
            $this->validate($request,
            [    
            'catename'=>'required',
            'content'=>'required'
            ],[
                'catename.required'=>'Category name required',
                'catename.unqiue'=>'Already taken category name',
                'content.required'=>'Category content required',
            ]);
            $updateData=array(
                'catename'=>$request->input('catename'),
                'cateslug'=>Str::slug($request->input('catename'),'-'),
                'content'=>$request->input('content'),
                'created_at'=>date('Y-m-d')
            );
            //return $request->hasFile('cateimage');
            if($request->hasFile('cateimage'))
            {
                $imagename=time().'_'.$request->cateimage->getClientOriginalName();
                // echo $imagename;die;
                $request->cateimage->move(public_path('uploads/category/'),$imagename);
                $updateData['cateimage']=$imagename;
            }
                $update=Category::where(array('id'=>$id))->update($updateData);
            if($update){
                $notification=['success'=>'Updated category records'];
                return back()->with($notification);
            }
            else{
                $notification=['error'=>'Unable to update category'];
                return back()->with($notification);
            }
        }
        else{
            $detail=Category::find($id);
            //return $detail;
            return view('admin.category.edit',['detail'=>$detail]);
        }
    }
}
