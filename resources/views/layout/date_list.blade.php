@extends('master')
@section('title','Date List')
@section('content')
<div class="content-wrapper" style="min-height: 501px;">
	<section class="content">
		<div class="row">
			@foreach($day as $d)
			<div class="col-md-3" >
				<div class="box box-<?php if($d->check_date==date('Y-m-d'))
				{
					echo "danger";
				}else{
					echo "success";
				} 
				?> box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">
							{{$d->check_date}}
						</h3>

						<!-- <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div> -->
						<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<a href="admin/statistics-timelog-per-day-list/{{$d->check_date}}" class="small-box-footer">
					Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			@endforeach
		</div>
	</section>
</div>
@endsection