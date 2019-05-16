@extends('master')
@section('title','Checkout')
@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Checkout Data</h3>                                    
	</div><!-- /.box-header -->
	<div class="box-body table-responsive">
		<div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
			<div class="row">
				<div class="col-xs-6">
					<div id="example1_length" class="dataTables_length">
						<label>
							<select  name="example1_length" aria-controls="example1">
								<?php
                                $t=1;
                                for ($i=1;$i<=12;$i++) {
                                    $t++; ?>
									<option value="<?echo $t;?>"><?echo $t;?></option>
									<?php
                                }
                                ?>
								</select> records per page</label>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="dataTables_filter" id="example1_filter" style="margin-left: 300px;">
								<label>Search: 
									<input type="text" aria-controls="example1">
								</label>
							</div>
						</div>
					</div>
					<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 176px;">STT</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 260px;">Username</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 233px;">Start_hour</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 149px;">Finish_hour</th>
								@if(Auth::user()->role==1)
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 105px;">Action</th>
								@endif
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th rowspan="1" colspan="1">STT</th>
								<th rowspan="1" colspan="1">Username</th>
								<th rowspan="1" colspan="1">Start_hour</th>
								<th rowspan="1" colspan="1">Finish_hour</th>
								@if(Auth::user()->role==1)
								<th rowspan="1" colspan="1">Action</th>
								@endif
							</tr>
						</tfoot>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							@foreach($user as $u)
							<tr class="odd">
								<td class="  sorting_1">{{$loop->iteration}}</td>
								<td class=" ">{{$u->fullname}}</td>
								<td class=" ">{{$u->start_hour}}</td>
								<td class=" ">{{$u->finish_hour}}</td>
								@if(Auth::user()->role==1)
								<td class=" ">
									<div class="btn-group">
										<button type="button" class="btn btn-success">Action</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Edit</a></li>
											<li><a href="#">Delete</a></li>
										</ul>
									</div>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="col-xs-6">
						<div class="dataTables_paginate paging_bootstrap">
							<ul class="pagination">
								{{$user->links()}}
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>
	@endsection