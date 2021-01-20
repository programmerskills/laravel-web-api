@extends('admin.layout.masterlayout')
    @section('content')
        <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1>Projects <span class="table-project-n">Data</span> Table</h1>
                                        <div class="sparkline13-outline-icon">
                                            <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
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
                                                    <th>Category</th>
                                                    <th>Subcategory</th>
                                                    <th>Created</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{dd($category)}}  --}}
                                            @if(!empty($subcategory))
                                            @php $sn=1;@endphp
                                            @foreach($subcategory as $res)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$sn}}</td>
                                                    <td><img src="{{asset('/public/uploads/subcategory')}}/{{$res->image}}" height="40" width="40"></td>
                                                    <td>{{$res->category->catename}}</td>
                                                    <td>{{ $res->subcate }}</td>
                                                    <td>{{date('d-m-Y',strtotime($res->created_at))}}</td>
                                                    <td><a href="{{url('/admin/editsubcategory')}}/{{$res->id}}">Edit</a></td>
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