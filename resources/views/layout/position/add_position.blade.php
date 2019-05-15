@extends("master")
@section('title','position')
@section('content')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form  role="form" action="{{route('admin.addPosition')}}" method="post" >
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Position name :</label>
                <input type="text" class="form-control" id="position_name" name="position_name" placeholder="Enter postion name">
                @if($errors->first('position_name'))
                <span class="text-danger">{{$errors->first('position_name')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Department :</label>
                <select name="department" class="form-control" >
                    @foreach($de as $d)
                    <option value="{{$d->id}}">{{$d->department_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Description :</label>
                <textarea class="form-control" rows="3" placeholder="Enter description" id="description" name="description" ></textarea>
                 @if($errors->first('description'))
                <span class="text-danger">{{$errors->first('description')}}</span>
                @endif
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
 $(document).ready(function(){
    tinymce.init({
        selector: 'textarea',
        plugins : 'advlist autolink link image lists charmap print preview'
    });

})
</script>
@endsection