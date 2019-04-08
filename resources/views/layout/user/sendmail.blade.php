@extends('master')
@section('title','Send mail')
@section('content')
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
		</div>
		<form action="{{route('admin.sendmail')}}" method="post">
			@csrf
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">TO:</span>
						<input name="user_recive" id="user_recive" type="text" class="form-control" placeholder="Email TO*">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Title:</span>
						<input name="title" id="title" type="text" class="form-control" placeholder="Title*">
					</div>
				</div>
				<div class="form-group">
					<textarea name="content" id="content" class="form-control" placeholder="Message*" style="height: 120px;"></textarea>
				</div>
				<div class="form-group">                                
					<div class="btn btn-success btn-file">
						<i class="fa fa-paperclip"></i> Attachment
						<input type="file" name="attachment">
					</div>
					<p class="help-block">Max. 32MB</p>
				</div>

			</div>
			<div class="modal-footer clearfix">

				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

				<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div>
@endsection