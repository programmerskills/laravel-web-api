<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
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
    
    function addcategory(Request $request)
    {   
        if($request->isMethod('post'))
        {
            $this->validate($request,
            [    
            'catename'=>'required|unique:categories,catename',
            'content'=>'required',
            'cateimage'=>'required|image|mimes:jpeg,jpg,png',
            ],[
                'catename.required'=>'Category Name required'
            ]);
        //return $request()->all();
        $addData=array(
            'catename'=>$request->input('catename'),
            'cateslug'=>Str::slug($request->input('catename'),'-'),
            'created_at'=>date('Y-m-d')
        );
        if($request->hasFile('image'))
        {
            $imagename=time().'_'.$request->image->getClientOriginalName();
            //echo $imagename;
            $request->image->move(public_path('uploads/category/'),$imagename);
            $addData['cateimage']=$imagename;
        }
        if(DB::table('categories')->insert($addData))
        {
            return back()->with(['success','Added Category Records']);
        }
        else
        {
            return back()->with(['error','Unable to Add Category']);
        }
        }
        else{
            return view('admin.category.add');
        }
        
        
    }
}
