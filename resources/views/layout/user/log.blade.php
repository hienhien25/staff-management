@extends('master')
@section('title','Log')
@section('pagecss')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
	#customers {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#customers td, #customers th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
@endsection
@section('content')
<div class="modal-header">
	<table>
		<tr>
			<td>
				<h4 class="modal-title" >
					<img src="images/history-512.png" class="img-circle" alt="User Image" style="width:30px; height: 30px;">
				</h4>
			</td>
			<td><span ><b>HISTORY</b></span></td>
			<td style="width:90%;"></td>
			<td>
				<form action="{!! URL::route('admin.deleteMany') !!}" method="post" >
					<a type="button" class="btn btn-primary delete_all" id="btndelete" data-url="{!! URL::route('admin.deleteMany') !!}" >Delete All</a>
				</form>
				
			</td>
		</tr>
	</table>
</div>
@csrf
<table id="customers">
	<tr>
		<th ><input type="checkbox" id="master"></th>
		<th>Time</th>
		<th>Active</th>
	</tr>
	@foreach($log as $l)
	<tr class="log" data-row-id="{{$l->id}}" >
		<td>
			<input type="checkbox" data-id="{{$l->id}}" id="btncheck" name="btncheck" class="btncheck">
		</td>
		<td id="timelog" value="{{$l->datetime_log}}">{{$l->datetime_log}}</td>
		<td id="action" value="{{$l->action}}">
			{{$l->action}}
		</td>
	</tr>
	@endforeach
</table>
<div class="row">
	<div class="col-xs-6">
		<div class="dataTables_paginate paging_bootstrap">
			<ul class="pagination">
				{{$log->links()}}
			</ul>
		</div>
	</div>
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
	$(document).ready(function(){
		$('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".btncheck").prop('checked', true);  
         } else {  
            $(".btncheck").prop('checked',false);  
         }  
        });
        $('.delete_all').on('click',function(e){
        	var allVals = [];  
            $(".btncheck:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            }); 
            if(allVals.length<=0){
            	alert('You have to select option !');
            }else{
            	var check=confirm('Are you sure you want to delete all data record ?');
            	if (check===true) {
            		var url = $(this).attr('data-url');
            		$.ajax({
            			url: url,
            			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            			type: 'POST',
            			data: {
            				code: allVals
            			},
            			success:function(data){
            				if(data['success']){
            					$(".btncheck:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
            				}
            			}
            		});
            	}
            } 
        });
	});
</script>
@endsection
