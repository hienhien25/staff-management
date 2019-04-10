@extends('master')
@section('title','Add member')
@section('content')
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.history.back();">×</button>
			<h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Add member </h4>
		</div>
		<form action="{{route('admin.addmember')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Fullname:</span>
						<input name="fullname" id="fullname" type="text" class="form-control" placeholder="Fullname*">
					</div>
					@if($errors->first('fullname'))
					<span class="text-danger">{{$errors->first('fullname')}}</span>
					@endif
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Email:</span>
						<input name="email" id="email" type="text" class="form-control" placeholder="Email*">
					</div>
					@if($errors->first('email'))
					<span class="text-danger">{{$errors->first('email')}}</span>
					@endif
				</div>
				<div class="form-group">
					<label >Department:</label>
					<select name="department" class="form-control" >
						@foreach($de as $d)
						<option value="{{$d->id}}">{{$d->department_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Role:</label>
					<select class="form-control" id="role" name="role">
						<option value="0">User</option>
						<option value="1">Admin</option>
					</select>
				</div>
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.replace('http://staff-manage.local/admin')" >Cancel</button>
				<button type="submit" class="btn btn-primary pull-left"> OK</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div>
@endsection
