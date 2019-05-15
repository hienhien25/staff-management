@extends('master')
@section('title','Checkin')
@section('content')
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.history.back();">×</button>
			<h4 class="modal-title" style="color: blue;text-align: center;"><i class="fa fa-fw fa-check-square-o"></i>Checkin : {{$dt->toDayDateTimeString()}} </h4>
		</div>
		<form action="{{route('admin.checkin')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"> Start hours:</span>
						<input type="time" class="form-control" id="start_hour" name="start_hour">
					</div>
					@if($errors->first('start_hour'))
					<span class="text-danger">{{$errors->first('start_hour')}}</span>
					@endif
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Finish hours:</span>
						<input type="time" class="form-control" id="finish_hour" name="finish_hour">
					</div>
					@if($errors->first('finish_hour'))
					<span class="text-danger">{{$errors->first('finish_hour')}}</span>
					@endif
				</div>

			</div>
			<div class="modal-footer clearfix">

				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.replace('http://staff-manage.local/admin');" ></i>Cancel</button>

				<button type="submit" class="btn btn-primary pull-left" id="checkin"></i> OK</button>
			</div>
		</form>
	</div>
</div>
@endsection 
@section('pagejs')
<script type="text/javascript">
	$('#checkin').click(function(){
		var start_h=$("#start_hour").val();
		var finish_h=$("#finish_hour").val();
		//alert(start_h);
		$.ajax({
			type : "POST",
			url:"<?php echo url('/admin/checkin') ?>", 
			data:{start_hour:start_h,finish_hour:finish_h}
			success: function(){
				alert('ok');
			}
		});
	});
	
</script>
@endsection