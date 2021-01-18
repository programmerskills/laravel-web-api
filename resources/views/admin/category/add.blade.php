@extends('admin.layout.masterlayout')
@section('content')
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
                               
                                <script>
                                if(json($success)){
                                    var app = @json($success);
                                    document.write(app);
                                }
                                </script>
                                
                                <div class="sparkline11-graph">
                                    <div class="input-knob-dial-wrap">
                                        <div class="row">
                                            <form method="post" action="{{url('/add')}}">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Basic Select</label>
                                                    <input type="text" name="catename" class="form-control">
                                                </div>
                                                <input type="submit" value="Add New" class="form-control">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
