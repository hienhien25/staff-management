@extends('master')
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
                                        <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Full name</th>
                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Password</th>
                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Role</th>
                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">STT</th>
                                                <th rowspan="1" colspan="1">Full name</th>
                                                <th rowspan="1" colspan="1">Email</th>
                                                <th rowspan="1" colspan="1">Password</th>
                                                <th rowspan="1" colspan="1">Role</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                        </tfoot>
                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                        @foreach($user as $u)
                                        <tr class="odd">
                                                <td class="  sorting_1">{{$loop->iteration()}}</td>
                                                <td class=" ">{{$u->fullname}}</td>
                                                <td class=" ">{{$u->email}}</td>
                                                <td class=" ">{{$u->password}}</td>
                                                <td class=" ">{{$u->role}}</td>
                                                <td></td>
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
                                        			<li class="active"><a href="#">{{$user->links()}}</a></li>
                                        			<li class="next"><a href="#">Next → </a></li></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
@endsection