@extends('master')
@section('title','Log')
@section('pagecss')
<style>
	#customers {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#customers td, #customers th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
@endsection
@section('content')
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.history.back();">×</button>
			<span class="close" ria-hidden="false">History</span>
			<h4 class="modal-title" >
				<img src="{{Auth::user()->image}}" class="img-circle" alt="User Image" style="width:30px; height: 30px;">
				<span >{{Auth::user()->fullname}}</span>
			</h4>
		</div>
		<table id="customers">
			<tr>
				<th>STT</th>
				<th>Time</th>
				<th>Active</th>
			</tr>
			@foreach($log as $l)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$l->datetime_log}}</td>
				<td>
					{{$l->action}}
				</td>
			</tr>
			@endforeach
		</table>
		<div class="row">
			<div class="col-xs-6">
				<div class="dataTables_paginate paging_bootstrap">
					<ul class="pagination">
						{{$log->links()}}
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
