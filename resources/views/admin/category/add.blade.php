@extends('admin.layout.masterlayout')
    @section('pagename')
    Add Category
    @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                     <div class="container-fluid">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="sparkline11-list shadow-reset mg-t-30">
                                <div class="sparkline11-hd">
                                    <div class="main-sparkline11-hd">
                                        <h1>Select 2</h1>
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
                                            <form method="post" action="{{url('/admin/addcategory')}}">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Category</label>
                                                    <input type="text" name="catename" class="form-control" value="{{old('catename')}}">
                                                    <span style="color:red;">{{ $errors->first('catename') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>content</label>
                                                    <textarea class="form-control" id="content" name="content" rows="4">{{old('content')}}</textarea>
                                                    <span style="color:red;">{{ $errors->first('content') }}</span>
                                                </div>
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>content</label>
                                                    <input type="file" class="form-control" name="cateimage" id="cateimage">
                                                    <span style="color:red;">{{ $errors->first('cateimage') }}</span>
                                                </div>
                                                
                                                <input type="submit" value="Add Category" class="btn btn-primary">
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

