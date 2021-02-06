@extends('admin.layout.masterlayout')
    @section('content')
        <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1>Manage Products </h1>
                                        <div class="sparkline13-outline-icon">
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        <div id="toolbar">
                                            <select class="form-control">
                                                <option value="">Export Basic</option>
                                                <option value="all">Export All</option>
                                                <option value="selected">Export Selected</option>
                                            </select>
                                        </div>
                                        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                            <thead>
                                                <tr>
                                                    <th data-field="state" data-checkbox="true"></th>
                                                    <th data-field="id">SN</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Subcategory</th>
                                                    <th>Child Category</th>
                                                    <th>Created</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            @if(!empty($products))
                                            @php $sn=1;@endphp
                                            @foreach($products as $res)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$sn}}</td>
                                                    <td><img src="{{asset('/public/uploads/product')}}/{{$res->featured_img}}" height="40" width="40"></td>
                                                    <td>{{$res->product_title}}</td>
                                                    <td>{{optional($res->category)->catename}}</td>
                                                    <td>{{optional($res->subcategory)->subcate}}</td>
                                                    <td>{{optional($res->childcategory)->subchild_name}}</td>
                                                    <td>{{date('d-m-Y',strtotime($res->created_at))}}</td>
                                                    <td><a href="{{url('/admin/editproduct')}}/{{$res->id}}">Edit</a></td>
                                                </tr>
                                                @php $sn++; @endphp
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            @endif
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- data table JS
        ============================================ -->
   
    @endsection