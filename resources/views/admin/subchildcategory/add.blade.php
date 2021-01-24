@extends('admin.layout.masterlayout')
    @section('pagename')
    Add Sub Child Category
    @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                     <div class="container-fluid">
                    <div class="row">
                       
                        <div class="col-lg-12">
                        @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                        @endif
                        @if(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}}</div>
                        @endif
                        
                            <div class="sparkline11-list shadow-reset mg-t-30">
                                <div class="sparkline11-hd">
                                    <div class="main-sparkline11-hd">
                                        <h1>Sub Child Category</h1>
                                       
                                    </div>
                                </div>
                                <div class="sparkline11-graph">
                                    <div class="input-knob-dial-wrap">
                                        <div class="row">
                                            <form method="post" action="{{url('/admin/addchildcategory')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Category</label>
                                                   <select name="cat_id" id="cat_id" class="form-control">
                                                        @if(!empty($category))
                                                            <option value="">Select Category</option>
                                                                @foreach($category as $allcategory)
                                                                <option value="{{$allcategory->id}}">{{$allcategory->catename}}</option>
                                                                @endforeach
                                                        @else
                                                            <option value="">No category</option>
                                                        @endif
                                                   </select>
                                                    <span style="color:red;">{{ $errors->first('cat_id') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                <select name="subact_id" id="subcat_id" class="form-control">
                                                <option value="">Select Subcategory</option>    
                                                   </select>
                                                    <span style="color:red;">{{ $errors->first('subact_id') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>SubChild Name</label>
                                                  <input type="text" class="form-control" name="subchild_name" id="subchild_name">
                                                    <span style="color:red;">{{ $errors->first('subchild_name') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Content</label>
                                                    <textarea class="form-control" id="content" name="content" rows="4">{{old('content')}}</textarea>
                                                    <span style="color:red;">{{ $errors->first('content') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Image</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    <span style="color:red;">{{ $errors->first('image') }}</span>
                                                </div>
                                                
                                                <input type="submit" value="Add Subcategory" class="btn btn-primary">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                <script>
    CKEDITOR.replace( 'content' );

    
    $(document).ready(function(){
        $('#cat_id').on('change',function(){
            var cat_id=$(this).val();
            $.ajax({
                url: '{{url("/")}}/admin/subcategoryFromCategory',
                method: 'post',
                data: {'_token':'{{csrf_token()}}','cat_id':cat_id},
                type: 'json',
                success: function(response)
                {
                    var json=JSON.parse(response);
                    var subcate='';
                    if(json.status==0){
                        subcate='<option value="">No Subcategory</option>';
                       
                    }
                    else if(json.status==1)
                    {   
                        subcate+='<option vlaue="">Select Subcategory</option>';
                        $.each(json.data,function(key, value){
                            subcate+='<option value="'+value.id+'">'+value.subcate+'</option>';
                        });
                    }               
                    $('#subcat_id').empty();
                    $('#subcat_id').append(subcate);
                }
            });          
        });
    });
    </script>
@endsection

