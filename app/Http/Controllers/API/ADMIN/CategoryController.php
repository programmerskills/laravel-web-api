<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $successStatus = 200;
    function add(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'catename'=>'required|unique:categories,catename',
        ]);
        //return $request()->all();
        if($validator->fails())
        {
            return response()->json(['verror'=>$validator->errors()],401);
        }
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
            return response()->json(['success'=>'Added Category Records'],$this-> successStatus);  
        }
        else
        {
            return response()->json(['error'=>'Unable to Add Category'],$this-> successStatus);
        }
    }
}
