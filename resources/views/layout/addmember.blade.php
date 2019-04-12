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
						<span class="input-group-addon">Email:</span>
						<input name="email" id="email" type="text" class="form-control" placeholder="Email*">
					</div>
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
