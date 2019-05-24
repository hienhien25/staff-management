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
				<td>
					<?php
                    $un=\App\User::where('id', $t->user_id)->first();
                    echo $un->fullname;
                    ?>
				</td>
				<td>
					<?php
                    if ($t->status==0) {
                        ?>

						<i class="fa fa-circle text-success" title="Checkin"></i> 
						<?php
                    } elseif ($t->status==1) {
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
							<li><a type="button" data-toggle="modal" data-id="{{$t->id}}" data-target="#edit" class="btnedit">Edit</a></li>
							<li><a type="button" id="btndelete" class="btndelete" data-id="{{$t->id}}">Delete</a></li>
							<li><a type="button" data-toggle="modal" data-id="{{$t->id}}" data-target="#myModal" class="btndetail">Detail</a></li>
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
<!-- function edit -->

<div class="modal fade" id="edit" >
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Edit</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				<form action="" method="post" id="formedit">
					<div class="form-group">
						<div class="input-group" id="checkin">
							
						</div>
					</div>
					<div class="form-group">
						<div class="input-group" id="checkout">
							
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Save</button>
			</div>

		</div>
	</div>
</div>
<!-- Detail  -->
<div class="modal fade" id="myModal" >
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Detail</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<table id="check">
					<tr>
						<td>Checkin : </td>
						<td >

						</td>
					</tr>
					<tr>
						<td>Checkout :</td>
						<td></td>


					</tr>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
	$(document).ready(function(){
		$('.btndetail').click(function(){
			var id=$(this).attr('data-id');
			//alert(id);
			$.get("/admin/detail-time-log/"+id,function(data){
				$("#check").html(data);
			});
		});
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
	$('.btnedit').click(function(){
		var id=$(this).attr('data-id');
		//alert(start);
		$.get("/admin/get-edit-time-log/"+id,function(data){
			//alert(data['checkin_time']);
			$('#checkin').html('<span class="input-group-addon"> Start hours:</span><input type="time" class="form-control" id="start_hour" name="start" value="'+data.checkin_time+'">');
			$('#checkout').html(' <span class="input-group-addon"> Finish hours:</span><input type="time" class="form-control" id="finish_hour" name="finish" value="'+data.checkout_time+'">');
		});

		$('#save').click(function(){
			var start=$('#start_hour').val();
			//alert(start);
			var finish=$('#finish_hour').val();
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
						url:"<?php echo url('/admin/edit-time-log');?>",
						data:{'id':id,'start':start,'finish':finish},
						success:function(data){
							if(data['success']){
								swal("Edit!", "Successfully!", "success");
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