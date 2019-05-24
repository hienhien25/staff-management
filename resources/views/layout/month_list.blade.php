@extends('master')
@section('title','Month List')
@section('content')
<section class="content-header">
	<!-- <div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>
						150
					</h3>
					<p>
						New Orders
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="#" class="small-box-footer">
					More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div> -->
		@foreach($month as $m )
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-<?php 
			$mon=\Carbon\Carbon::now()->month;
			if($m->month==$mon)
			{
				echo "red";
			}else{
				echo "green";
			}
			?>">
				<div class="inner">
					<h3>
						{{$m->month}}<sup style="font-size: 20px"></sup>
					</h3>
					<p>
						Statistics 
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="admin/statistics-date-list/{{$m->id}}/{{$m->month}}.html" class="small-box-footer">
					More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		@endforeach
	</div>
</section>
@endsection