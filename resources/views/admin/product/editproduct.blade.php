@extends('admin.layout.masterlayout')
    @section('pagename')
    Edit Product
    @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                     <div class="container-fluid">
                    <div class="row">
                       
                        <div class="col-lg-12">
                        @php 
                            $rand="abcdef0123456789";
                            $colorcode=substr(str_shuffle($rand),0,6)
                        @endphp
                        
                        @if(session()->has('success'))
                        <div class="alert alert-success" style="background-color:#{{$colorcode}}">{{session()->get('success')}}</div>
                        @endif
                        @if(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}}</div>
                        @endif
                        
                            <div class="sparkline11-list shadow-reset mg-t-30">
                                <div class="sparkline11-hd">
                                    <div class="main-sparkline11-hd">
                                        <h1>Edit Product</h1>
                                       
                                    </div>
                                </div>
                                <div class="sparkline11-graph">
                                    <div class="input-knob-dial-wrap">
                                        <div class="row">
                                            <form method="post" action="{{url('/admin/editproduct')}}/{{$details->id}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Category</label>
                                                   <select name="cat_id" id="cat_id" class="form-control">
                                                        @if(!empty($category))
                                                            <option value="">Select Category</option>
                                                                @foreach($category as $allcategory)
                                                                <option value="{{$allcategory->id}}" @if($details->cat_id==$allcategory->id){{"selected"}}@endif>{{$allcategory->catename}}</option>
                                                                @endforeach
                                                        @else
                                                            <option value="">No category</option>
                                                        @endif
                                                   </select>
                                                    <span style="color:red;">{{ $errors->first('cat_id') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                <select name="subcat_id" id="subcat_id" class="form-control">
                                                <option value="">Select Subcategory</option> 
                                                @if(!empty($subcategory))
                                                    @foreach($subcategory as $sub)
                                                        <option value="{{$sub->id}}" @if($details->subcat_id==$sub->id){{"selected"}}@endif>{{$sub->subcate}}</option>
                                                    @endforeach
                                                @endif   
                                                   </select>
                                                    <span style="color:red;">{{ $errors->first('subact_id') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                <select name="childcat_id" id="childcat_id" class="form-control">
                                                <option value="">Select Child Category</option> 
                                                @if(!empty($childcategory))
                                                    @foreach($childcategory as $child)
                                                        <option value="{{$child->id}}" @if($details->childcat_id==$child->id){{"selected"}}@endif>{{$child->subchild_name}}</option>
                                                    @endforeach
                                                @endif   
                                                   </select>
                                                    <span style="color:red;">{{ $errors->first('childcat_id') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Product Title</label>
                                                  <input type="text" class="form-control" name="product_title" id="product_title" value="{{$details->product_title?$details->product_title : old('product_title')}}">
                                                    <span style="color:red;">{{ $errors->first('product_title') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Regular Price</label>
                                                  <input type="text" class="form-control" name="reg_price" id="reg_price" value="{{$details->reg_price?$details->reg_price : old('reg_price')}}">
                                                    <span style="color:red;">{{ $errors->first('reg_price') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Sale Price</label>
                                                  <input type="text" class="form-control" name="sale_price" id="sale_price" value="{{ $details->sale_price?$details->sale_price : old('sale_price')}}">
                                                    <span style="color:red;">{{ $errors->first('sale_price') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Short Description</label>
                                                    <textarea class="form-control" id="short_desc" name="short_desc" rows="4">{{$details->short_desc?$details->short_desc : old('short_desc')}}</textarea>
                                                    <span style="color:red;">{{ $errors->first('short_desc') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Long Description</label>
                                                    <textarea class="form-control" id="long_desc" name="long_desc" rows="4">{{ $details->long_desc?$details->long_desc : old('long_desc')}}</textarea>
                                                    <span style="color:red;">{{ $errors->first('long_desc') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Featured Image</label>
                                                    <input type="file" class="form-control" name="featured_img" id="featured_img">
                                                    <span style="color:red;">{{ $errors->first('featured_img') }}</span>
                                                    <br>
                                                    <img src="{{asset('/public/uploads/product')}}/{{ $details->featured_img }}" alt="" height="40" width="40">

                                                </div>
                                            </div>
                                            @if(!empty($productgallery))
                                            @php $i=1; @endphp
                                                @foreach($productgallery as $gallery)
                                                <div class="col-md-3">
                                                    <div class="chosen-select-single mg-b-20">
                                                        <label>Product Gallery {{$i}}</label>
                                                        <input type="file" class="form-control" name="product_gallery[]" id="product_gallery"><br>
                                        <img src="{{asset('/public/uploads/productgallery')}}/{{$gallery->product_gallery}}" alt="" height="50" width="50">
                                                    </div>
                                                    <input type="text" name="gal_id[]" value="{{$gallery->id}}">
                                            </div>
                                            @php $i++; @endphp
                                                @endforeach
                                            @endif
                                            
                                            <div id="progallery"></div>
                                                <div class="col-md-3">
                                                    <div class="chosen-select-single mg-b-20" style="margin-top: 25px;">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-success" name="addmore" id="addmore">Add More</button>&nbsp;<button type="button" class="btn btn-danger" name="remove" id="remove">Remove</button>
                                    
                                                    </div>
                                                </div>

                                            <div class="col-md-12">
                                            <input type="submit" value="Edit Product" class="btn btn-primary">
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
    CKEDITOR.replace( 'short_desc' );
    CKEDITOR.replace( 'long_desc' );

    
    $(document).ready(function(){
        // subcatgory
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
                        subcate='<option value="">Select Subcategory</option>';
                        subcate+='<option value="">No record found</option>';
                       
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
                    childcat='<option value="">Select Child Category</option>';
                    $('#childcat_id').empty();
                    $('#childcat_id').append(childcat);
                }
            });          
        });
        // child subcatgory
        $('#subcat_id').on('change',function(){
            var cat_id=$('#cat_id').val();
            var subcat_id=$(this).val();
            $.ajax({
                url: '{{url("/")}}/admin/chidCategoryFromSubcategory',
                method: 'post',
                data: {'_token':'{{csrf_token()}}','cat_id':cat_id,'subcat_id':subcat_id},
                type: 'json',
                success: function(response)
                {
                    var json=JSON.parse(response);
                    var childcat='';
                    if(json.status==0){
                        childcat='<option value="">Select Child Category</option>';
                        childcat+='<option value="">No record found</option>';
                       
                    }
                    else if(json.status==1)
                    {   
                        childcat+='<option vlaue="">Select Child Category</option>';
                        $.each(json.data,function(key, value){
                            childcat+='<option value="'+value.id+'">'+value.subchild_name+'</option>';
                        });
                    }               
                    $('#childcat_id').empty();
                    $('#childcat_id').append(childcat);
                }
            });          
        });
    });
     // add more gallery 
     $(document).ready(function(){
        var i=2;
        $('#addmore').click(function(){
           $('#progallery').append('<div class="col-md-3"><div class="chosen-select-single mg-b-20"><label>Product Gallery '+i+'</label><input type="file" class="form-control" name="product_gallery[]" id="product_gallery" required></div></div><input type="hidden" name="gal_id[]" value="0">');
           i=i+1;
        });
       
        $('#remove').click(function(){
            $("#progallery").children().last().remove(); 
        });
        
    });
    </script>
@endsection

