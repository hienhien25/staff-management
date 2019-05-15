@extends('master')
@section('title','Edit Checkin ')
@section('content')
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"></h3>
	</div><!-- /.box-header -->
	<!-- form start -->
	<form  action="admin/edit-checkout/{{$chk->id}}.html" method="post" >
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Start hours:</label>
				<input type="time" class="form-control" id="start_hour" name="start_hour" value="{{$chk->start_hour}}" placeholder="Enter Start hours*">
				@if($errors->first('start_hour'))
				<span class="text-danger">{{$errors->first('start_hour')}}</span><br/>
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Finish hours:</label>
				<input type="time" class="form-control" id="finish_hour" name="finish_hour" value="{{$chk->finish_hour}}" placeholder="Enter Finish hours*">
				@if($errors->first('finish_hour'))
				<span class="text-danger">{{$errors->first('finish_hour')}}</span><br/>
				@endif
			</div>
		</div><!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
</div>
@endsection