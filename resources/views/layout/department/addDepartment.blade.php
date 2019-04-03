@extends('master')
@section('title','List')
@section('content')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form  action="{{route('admin.addDepartment')}}" method="post" >
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Department name :</label>
                <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter Department">
            </div>
            <div class="form-group">
                <label>Quantity :</label>
                <textarea class="form-control" rows="3" placeholder="Enter description" id="quantity" name="quantity" ></textarea>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection