@extends('layout.user.show_checkin_list')
@section('main')
<div class="w3-white w3-padding notranslate w3-padding-16">
	<table id="customers">
		<tbody>
			<tr>
				<th>STT</th>
				<th>Month</th>
				<th>Avatar</th>
				<th>Username</th>
				<th>Total Working Hours</th>
				<th>Total Leave Hours</th>
			</tr>
			@foreach($month as $m)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$m->month}}</td>
				<td ><img src="{{$m->image}}" style="width:30px; height: 30px;text-align: center;"></td>
				<td>{{$m->fullname}}</td>
				<td><?php $total=$m->total_working_hour; $t=$total/60; echo $t."hours";?></td>
				<td><?php $total=$m->total_leave_hour; $t=$total/60; echo $t."hours";?></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="col-xs-6">
		<div class="dataTables_paginate paging_bootstrap">
			<ul class="pagination">
				{{$month->links()}}
			</ul>
		</div>
	</div>
</div>
@endsection
