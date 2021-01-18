@extends('admin.layout.masterlayout')
    @section('pagename')
    Add Category
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
                                        <h1>Category</h1>
                                        <!-- <div class="sparkline11-outline-icon">
                                            <span class="sparkline11-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline11-collapse-close"><i class="fa fa-times"></i></span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="sparkline11-graph">
                                    <div class="input-knob-dial-wrap">
                                        <div class="row">
                                            <form method="post" action="{{url('/admin/editcategory')}}/{{$detail->id?$detail->id:''}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Category</label>
                                                    <input type="text" name="catename" class="form-control" value="{{$detail->catename?$detail->catename:old('catename')}}">
                                                    <span style="color:red;">{{ $errors->first('catename') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Content</label>
                                                    <textarea class="form-control" id="content" name="content" rows="4">{{ $detail->content?$detail->content:'' }}</textarea>
                                                    <span style="color:red;">{{ $errors->first('content') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Image</label>
                                                    <input type="file" class="form-control" name="cateimage" id="cateimage">
                                                    <span style="color:red;">{{ $errors->first('cateimage') }}</span>
                                                    
                                                    <img src="{{asset('/public/uploads/category')}}/{{$detail->cateimage?$detail->cateimage:''}}" alt="" height="40" width="40">
                                                </div>
                                                
                                                <input type="submit" value="Update Category" class="btn btn-primary">
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

