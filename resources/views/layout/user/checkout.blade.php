@extends('master')
@section('title','Checkout')
@section('content')
<div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.history.back();">×</button>
			<h4 class="modal-title" style="color: blue;text-align: center;"><i class="fa fa-fw fa-check-square-o"></i>Checkout  </h4>
		</div>
		<form action="{{route('admin.checkout')}}" method="post">
			@csrf
			<div class="modal-body">
				<table>
					<tr>
						<td>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"> Start:</span>
									<input type="time" class="form-control" id="start_hour" name="start_hour" value="{{$check->start_hour}}">
								</div>
								@if($errors->first('start_hour'))
								<span class="text-danger">{{$errors->first('start_hour')}}</span>
								@endif
							</div>
						</td>
						<td style="padding-left: 10px;">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Finish:</span>
									<input type="time" class="form-control" id="finish_hour" name="finish_hour" value="{{$check->finish_hour}}" >
								</div>
								@if($errors->first('finish_hour'))
								<span class="text-danger">{{$errors->first('finish_hour')}}</span>
								@endif
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer clearfix">

				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.replace('http://staff-manage.local/admin');" ></i>Cancel</button>

				<button type="submit" class="btn btn-primary pull-left" id="btncheckout" name="btncheckout"></i> OK</button>
			</div>
		</form>
	</div>
</div>
@endsection 
@section('pagejs')
<script type="text/javascript">
	$('#btncheckout').click(function(){
		var start_h=$("#start_hour").val();
		var finish_h=$("#finish_hour").val();
		//alert(start_h);
		$.ajax({
			type : "POST",
			url:"<?php echo url('/admin/checkout') ?>", 
			data:{start_hour:start_h,finish_hour:finish_h},
			success: function(){
				alert('ok');
			}
		});
	});
	
</script>
@endsection