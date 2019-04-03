@extends('master')
@section('title','List')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <th><a href="{{route('admin.addDepartment')}}" class="btn btn-primary">Add</a></th>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Department</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Quantity</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Department</th>
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                        </tfoot>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($dep as $d)
                            <tr class="odd">
                                <td class="  sorting_1">{{$loop->iteration}}</td>
                                <td class=" "><li style="text-decoration: none;"><a href="admin/PositionList/{{$d->id}}.html" >{{$d->department_name}}</a></li></td>
                                <td class=" ">{{$d->quantity}}</td>
                                <td class=" ">
                                    <a href="#" class="btn btn-info">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-6">
                           <div class="dataTables_paginate paging_bootstrap">
                              <ul class="pagination">
                                 <li class="prev disabled"><a href="#">← Previous</a>
                                 </li>
                                 <li class="active"><a href="#">{{$dep->links()}}</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div><!-- /.box-body -->
     </div><!-- /.box -->
 </div>
</div>
@endsection