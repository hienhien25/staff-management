@extends('master')
@section('title','personal')
@section('content')
<div class="box">
	<div class="box-body table-responsive">
		<div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
			<div class="row">
				<div class="col-xs-6">
					<div id="example1_length" class="dataTables_length">
						<div class="btn-group" style="width: 150px; align-items: center;">
							<a href="admin/export-statistic-personal" class="btn btn-warning" id="exportData" >Export Data</a>
						</div>
					</div>
				</div>
				<div class="box-header" >
					<div class="row" style="padding-left: 700px;">
						<form action="admin/search-statist" method="get" class="col-sm-4" >
							<div class="input-group input-group-sm" style="width: 300px; margin-top: 10px;margin-bottom: 15px;">
								<input type="text" class="form-control" name="keyword"  placeholder="Enter YYYY-mm-dd" >
								<span class="input-group-btn">
									<button type="submit" class="btn btn-info btn-flat">Search</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
			<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
				<thead>
					<tr role="row">
						<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 176px;">STT</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 260px;">Month </th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 260px;">Total working hours</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 233px;">Total leave hours</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th rowspan="1" colspan="1">STT</th>
						<th rowspan="1" colspan="1">Month</th>
						<th rowspan="1" colspan="1">Total working hours</th>
						<th rowspan="1" colspan="1">Total leave hours</th>
					</tr>
				</tfoot>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					@foreach($statist as $stat)
					<tr class="odd">
						<td class="  sorting_1" style="width:50px;">{{$loop->iteration}}</td>
						<td class=" ">{{$stat->month}}</td>
						<td><?php $total=$stat->total_working_hour; $t=$total/3600; 
										$min=($total%3600)/60;
										$s=$min%60;
										echo round($t).":".round($min).":".$s;?></td>
						<td><?php $total=$stat->total_leave_hour; $t=$total/3600; 
										$m=($total%3600)/60;
										$s=$min%60;
										echo round($t).":".round($m).":".$s;?></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="col-xs-6">
				<div class="dataTables_paginate paging_bootstrap">
					<ul class="pagination">
						{{$statist->links()}}
					</ul>
				</div>
			</div>
			
		</div>
	</div>
</div><!-- /.box-body -->
</div>

@endsection
<!-- @section('pagejs')
<script type="text/javascript">
	$(document).ready(function(){
		$('#exportData').click(function(){
			alert('ok');
		});
	});
</script>
@endsection -->