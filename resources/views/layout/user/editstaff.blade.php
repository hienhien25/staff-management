@extends('master')
@section('title','Edit')
@section('content')
@php
    $defaultImg = $st->image == null ? asset('images/ImageDefault.png') : $st->image;
@endphp
<div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fullname :</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter fullname*" value="{{}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email :</label>
                                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email*">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Address :</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter address*">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone number :</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone number*">
                                        </div>
                                        <div class="form-group">
 											 <label for="sel1">Position:</label>
  											<select class="form-control" id="sel1">
  											  <option>1</option>
  											</select>
										</div>
										<div class="form-group">
 											 <label for="sel1">Role :</label>
  											<select class="form-control" id="sel1">
  											  <option>1</option>
  											</select>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form">
                                        <!-- text input -->
                                        <div class="form-group">
                                             <div class="img">

                                                    <img id="preview" src="{{asset($defaultImg)}}" class="img-responsive">

                                                    </div>
                                                    <br/>
                                                    <div class="form-group">
                                                        <label>Ảnh sản phẩm </label>
                                                        <input type="file" name="image" onchange="encodeImageFileAsURL(this, 'preview')">
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Date of birth : </label>
                                            <input type="date" class="form-control"  disabled="">
                                        </div>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>
@endsection
@section('pagejs')
<script type="text/javascript">
         function encodeImageFileAsURL(element, deploySelector) {
            var file = element.files[0];
            if(file == undefined){
                $('#' + deploySelector).attr('src', $('#ImageDefault').val());
                return false;
            }
            var reader = new FileReader();
        }
</script>
@endsection