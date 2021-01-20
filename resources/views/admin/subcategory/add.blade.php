@extends('admin.layout.masterlayout')
    @section('pagename')
    Add Subcategory
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
                                        <h1>Subcategory</h1>
                                       
                                    </div>
                                </div>
                                <div class="sparkline11-graph">
                                    <div class="input-knob-dial-wrap">
                                        <div class="row">
                                            <form method="post" action="{{url('/admin/addsubcategory')}}" enctype="multipart/form-data">
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
                                                    <span style="color:red;">{{ $errors->first('catename') }}</span>
                                                </div>

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Subcategory</label>
                                                    <input type="text" name="subcate" class="form-control" value="{{old('subcate')}}">
                                                    <span style="color:red;">{{ $errors->first('subcate') }}</span>
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
                <script>
    CKEDITOR.replace( 'content' );
    </script>
@endsection

