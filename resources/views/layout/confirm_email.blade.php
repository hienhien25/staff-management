<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Email Authenication </title>
	<base href="{{asset('/')}}">
	@include('css')
</head>
<body class="be-splash-screen">
	<div class="be-wrapper" style="width:400px;  text-align:center;  margin:0 auto;position:absolute;left: 50%; top: 50%;transform: translateX(-50%) translateY(-50%);
	-webkit-transform: translateX(-50%) translateY(-50%);">
	<div class="be-content">
		<div class="main-content container-fluid">
			<form  method="post" action="{{route('confirmEmail')}}" data-toggle="validator" role="form">
				@csrf
				<div class="splash-container">
					<div class="panel panel-default panel-border-color panel-border-color-primary">
						<div class="panel-heading panel-heading-divider">
							<img src="images/logo.png" alt="logo" width="80px" height="80px" class="logo-img"><span class="splash-description"><h4 style="font-weight:bold;">Staff Management</h4><h5 style="font-weight:bold;">Email Authenication</h5></span>

						</div>
						<div class="panel-body">

							<div class="form-group">
								<input name="code" type="text" id="code" class="form-control" placeholder="Enter code*">
								@if(isset($msg))
								<span class="text-danger">{{session('msg')}}</span>
								@endif
							</div>
							<div class="splash-footer"><span><a class="btn btn-danger btn-xl" href="">OK</a></span></div>            
						</div>
					</div>

				</div></form>

				<script type="text/javascript">
					$('body').addClass('be-splash-screen');
					$('.be-wrapper').removeClass('be-fixed-sidebar');
				</script>
				<style>
					.splash-container .panel{
						margin-bottom: 0px !important;
					}
				</style>
			</div>
		</div>

	</div>
	@include('js')
</body>
</html>