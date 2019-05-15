@extends('master')
@section('title','Timelog')
@section('pagecss')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">          
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Username</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tl as $t)
			<tr>
				<td>{{$t->username}}</td>
				<td>
					<?php
					if($t->status==0)
					{
						?>

						<i class="fa fa-circle text-success" title="Checkin"></i> 
						<?php
					}
					else if($t->status==1)
					{
						?>

						<i class="fa fa-circle text-danger" title="Checkout"></i> 
						<?php
					}
					?>
				</td>
				<td>
					<div class="btn-group" style="width:200px;">
						<button type="button" class="btn btn-success">Action</button>
						<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Edit</a></li>
							<li><a type="button" id="btndelete" class="btndelete" data-id="{{$t->id}}">Delete</a></li>
							<li><a href="#">Detail</a></li>
						</ul>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="col-xs-6">
		<div class="dataTables_paginate paging_bootstrap">
			<ul class="pagination">
				{{$tl->links()}}
			</ul>
		</div>
	</div>
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
	$(document).ready(function(){
		$('.btndelete').click(function(){
			var id=$(this).attr('data-id');
			//alert(id);
			 swal({
              title: "Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
          },function(isConfirm){
          	if(isConfirm)
          	{
          		$.ajax({
          			type:'POST',
          			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          			url:"<?php echo url('/admin/delete-time-log');?>",
          			data:{'id':id},
          			success:function(data){
          				if(data['success']){
          					swal("Deleted!", "Successfully!", "success");
          				}
          			}
          		});
          	}else{
          		swal("Cancelled", "Your imaginary file is safe :)", "error");
          	}
          }
      	);
		});
	});
</script>
@endsection