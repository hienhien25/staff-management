@extends('master')
@section('title','Checkin')
@section('content')
<form action="{{route('admin.checkin')}}" method="post">
<h3 style="text-align: center;">Checkin : {{$dt->toDayDateTimeString()}}</h3>
<div class="form-group">
  Start hours:
  <input type="time" class="form-control" id="start_hour" name="start_hour">
 </div>
 <div class="form-group">
  Finish hours:
  <input type="time" class="form-control" id="finish_hour" name="finish_hour">
</div>
<div class="form-group">
  <input type="submit" class="btn btn-info" id="checkin" value="OK">
  <input type="reset" class="btn btn-info" value="Reset">
 </div>
</form>
@endsection 
@section('pagejs')
<script type="text/javascript">
	$('#checkin').click(function(){
		var start_h=$("#start_hour").val();
		var finish_h=$("#finish_hour").val();
		$.ajax({
			type : "POST",
			url:"app/Http/Controllers/Checkin.php", 
			data:{start_hour:start_h,finish_hour:finish_h}
		});
	});
</script>
@endsection