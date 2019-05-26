@extends('layout.mailbox')
@section('mail')
<div class="table-responsive">
	<!-- THE MESSAGES -->
	@if($count==0)
	<span class="text-danger">Không tìm thấy kết quả nào !</span>
	@else
	<span class="text-danger">Đã tìm thấy {{$count}} kết quả !</span>
	@endif
	<table class="table table-mailbox">
		<thead>
			<th></th>
			<th></th>
			<th>title</th>
			<th>Receiver</th>
			<th>Time</th>
		</thead>
		<tbody>
			@foreach($search as $em)
			<tr class="unread">
				<td class="small-col">
					<div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
						<input type="checkbox" style="position: absolute; opacity: 0;">
						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
					</div>
				</td>
				<td class="small-col"><i class="fa fa-star"></i></td>
				<td class="name"><a href="#">{{$em->title}}</a></td>
				<td class="subject"><a href="#">{{$em->user_recive}}</a></td>
				<td class="time">{{$em->created_at}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="col-xs-6">
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                {{$search->links()}}
            </ul>
        </div>
    </div>
</div><!-- /.table-responsive -->
@endsection