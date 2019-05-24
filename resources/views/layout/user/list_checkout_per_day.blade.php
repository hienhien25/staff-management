@extends('layout.user.show_checkin_list')
@section('main')
<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
	<thead>
		<tr role="row">
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 176px;">STT</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 260px;">Avatar</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 260px;">Username</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 233px;">Start_hour</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 149px;">Finish_hour</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 149px;">Total</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 149px;">Status</th>
			<!-- @if(Auth::user()->role==1)
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 105px;">Action</th>
			@endif -->
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th rowspan="1" colspan="1">STT</th>
			<th rowspan="1" colspan="1">Avatar</th>
			<th rowspan="1" colspan="1">Username</th>
			<th rowspan="1" colspan="1">Start_hour</th>
			<th rowspan="1" colspan="1">Finish_hour</th>
			<th rowspan="1" colspan="1">Total</th>
			<th>Status</th>
			<!-- @if(Auth::user()->role==1)
			<th rowspan="1" colspan="1">Action</th>
			@endif -->
		</tr>
	</tfoot>
	<tbody role="alert" aria-live="polite" aria-relevant="all">
		@foreach($user as $u)
		<tr class="odd">
			<td class="  sorting_1" style="width:50px;">{{$loop->iteration}}</td>
			<td><img src="{{$u->image}}" style="width:30px; height: 30px;"></td>
			<td class=" ">{{$u->fullname}}</td>
			<td class=" ">{{$u->start_hour}}</td>
			<td class=" ">{{$u->finish_hour}}</td>
			<td class=" ">
				<?php
                $start=\Carbon\Carbon::create($u->start_hour);
                $finish=\Carbon\Carbon::create($u->finish_hour);
                $totalperday=$finish->diffInMinutes($start);
                $total=$totalperday*60;
                $h=$total/3600;
                $m=($total%3600)/60;
                $s=$m%60;
                echo round($h).":".round($m).":".$s;
                ?>
			</td>
			<td>
				@if($u->status==0)
				<?php echo "Checkin"; ?>
				@elseif($u->status==1)
				<?php echo "Checkout";?>
				@endif
			</td>
			<!-- @if(Auth::user()->role==1)
			<td class=" " style="width:200px;">
				<div class="btn-group">
					<button type="button" class="btn btn-success">Action</button>
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="admin/edit-checkout/{{$u->id}}.html">Edit</a></li>
						<li><a class="btn btn-default waves-effect waves-light remove-record" data-toggle="modal" data-url="{!! URL::route('admin.deleteCheckin', $u->id) !!}" data-id="{{$u->id}}" data-target="#custom-width-modal">Delete</a></li>
					</ul>
				</div>
			</td>
			@endif -->
		</tr>
		@endforeach
	</tbody>
</table>
<div class="col-xs-6">
	<div class="dataTables_paginate paging_bootstrap">
		<ul class="pagination">
			{{$user->links()}}
		</ul>
	</div>
</div>
<!-- form delete -->
<!-- <form action="{{route('admin.deleteCheckin', $u->id)}}"  class="remove-record-model" method="post">
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Checkin</h4>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form> -->
@endsection
@section('pagejs')
<script type="text/javascript">
	$(document).ready(function(){
    $('.remove-record').click(function() {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var token = CSRF_TOKEN;
        $(".remove-record-model").attr("action",url);
        $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
        $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
        $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');

    });

    $('.remove-data-from-delete-form').click(function() {
        $('body').find('.remove-record-model').find( "input" ).remove();
    });
    $('.modal').click(function() {
         //$('body').find('.remove-record-model').find( "input" ).remove();
    });
});
</script>
@endsection