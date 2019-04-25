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
						<label>
							Tháng : 
							<select  name="month" aria-controls="example1" id="month">
								@foreach($month as $m )
								<option value="{{$m->id}}">{{$m->month}}</option>
								@endforeach
							</select>
						</label>
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
			@yield('main')
			
		</div>
	</div>
</div><!-- /.box-body -->
</div>
@endsection
