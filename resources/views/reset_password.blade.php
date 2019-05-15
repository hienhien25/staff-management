<!DOCTYPE html>
<html>
<head>
	<title>Reset</title>
</head>
<body>
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class="glyphicon glyphicon-asterisk"></i>Reset Password </h4>
		</div>
		<form action="admin/reset-password/{{$token}}.html" method="post" enctype="multipart/form-data">
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
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.replace('http://staff-manage.local/adminlogin')">Cancel</button>
				<button type="submit" class="btn btn-primary pull-left"> OK</button>
			</div>
		</form>
	</div>
</body>
</html>