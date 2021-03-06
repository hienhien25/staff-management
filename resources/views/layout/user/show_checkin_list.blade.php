@extends('master')
@section('title','Checkout')
@section('pagecss')
<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
</style>
@endsection
@section('content')
<div class="box">
	<div class="box-body table-responsive">
		<div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
			<div class="row">
				<div class="col-xs-6">
					<div id="example1_length" class="dataTables_length">
						<div class="btn-group" >
							<a type="button" class="btn btn-primary" href="admin/export-statistic-per-month" id="exportData">Export to excel</a>
							<div class="btn-group" >
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									Month  <span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu" name="month" id="month"  >
										@foreach($mon as $mo)
										<li ><a href="admin/search-statistic-each-month/{{$mo->id}}.html">{{$mo->month}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
							</div>
							</div>
						</div>
						<div class="box-header" >
							<div class="row" style="padding-left: 700px;">
								<form action="{{route('admin.search')}}" method="get" class="col-sm-4" >
									<div class="input-group input-group-sm" style="width: 300px; margin-top: 10px;margin-bottom: 15px;">
										<input type="text" class="form-control" name="keyword"  placeholder="Enter YYYY-mm-dd" >
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat">Search</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="box-body">
					@yield('main')
					</div>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>
	@endsection
@section('pagejs')
	<script type="text/javascript">
		$(document).ready(function(){
			var mon=$('#month').attr('value');
		//alert(mon);
		$('#exportData').click(function(){
			//alert(mon);
			//$.get("/admin/get-edit-time-log/"+id,function(data){
			$.ajax({
				type:'GET',
				url:"<?php echo url('/admin/export-statistic-per-month'); ?>",
				data:{'mon':mon},
				success:function(data){
					alert('ok');
				}
			});
		});
	</script>
	@endsection
