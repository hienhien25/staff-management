@extends('master')
@section('title','Staff management')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form  role="form" action="{{route('admin.user.addstaff')}}" 
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Fullname :</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter fullname*" name="fullname">
                    @if($errors->first('fullname'))
                    <span class="text-danger">{{$errors->first('fullname')}}</span><br/>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email*" name="email">
                    @if($errors->first('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password :</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone password*" name="password">
                    @if($errors->first('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Address :</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter address*" name="address">
                    @if($errors->first('address'))
                    <span class="text-danger">{{$errors->first('address')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone number :</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone number*" name="phone">
                    @if($errors->first('phone'))
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gender :</label>
                    <tr>

                        <td>
                            <input type="radio" name="gender" value="Nam"> Male
                            <input type="radio" name="gender" value="Nữ"> Female
                            <input type="radio" name="gender" value="Khác"> Other
                        </td>
                    </tr>
                </div>
                <div class="form-group">
                 <label for="sel1">Department :</label>
                 <select class="form-control" id="department" name="department">
                    <option></option>
                   @foreach($de as $d)
                   <option value="{{$d->id}}">{{$d->department_name}}</option>
                   @endforeach
               </select>
           </div>
           <div class="form-group">
             <label for="sel1">Role :</label>
             <select class="form-control" id="sel1" name="role">
                <option value="0">User</option>
                <option value="1">Admin</option>
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
            <form role="form" >
                <!-- text input -->
                <div class="form-group" style="width: 480px;margin: auto;padding-left: 50px;">
                    <label for="exampleInputFile">Avatar :</label>
                    <div class="img">
                        <img id="preview" src="{{asset('images/ImageDefault.png')}}" class="img-responsive">
                    </div>
                    <div class="form-group">
                        <input type="file" id="image" name="image"  onchange="encodeImageFileAsURL(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Larary :</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone larary*" name="larary">
                    @if($errors->first('larary'))
                    <span class="text-danger">{{$errors->first('larary')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Date of birth : </label>
                    <input type="date" class="form-control"   name="dob">
                    @if($errors->first('dob'))
                    <span class="text-danger">{{$errors->first('dob')}}</span>
                    @endif
                </div>
                <div class="form-group">
                 <label for="sel1">Position:</label>
                 <select class="form-control" id="position" name="position">
                    <option></option>
                   @foreach($pos as $p)
                   <option value="{{$p->id}}">{{$p->position_name}}</option>
                   @endforeach
               </select>
           </div>
       </form>
   </div><!-- /.box-body -->
</div><!-- /.box -->
</div><!--/.col (right) -->
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
 function encodeImageFileAsURL(element) {
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        $('#preview').attr('src', reader.result);
    }
    reader.readAsDataURL(file);
}
$(document).ready(function(){
    $("#department").change(function(){
        var iddepartment= $(this).val();
        //alert(iddepartment);
        $.get("/admin/ajaxdepartment/"+iddepartment,function(data){
            $("#position").html(data);
        });
    });
});
</script>
@endsection