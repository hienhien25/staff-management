@extends('master')
@section('title','Staff management')
@section('content')
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
               <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="{{route('admin.user.addStaff')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table style="width:100%;">
                                <tr>
                                    <td style="width: 580px; margin: auto;padding: auto;">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fullname :</label>
                                            <input type="text" class="form-control"  placeholder="Enter fullname*" name="fullname" style="width: 400px;">
                                            @if($errors->first('fullname'))
                                            <span class="text-danger">{{$errors->first('fullname')}}</span><br/>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email :</label>
                                            <input type="text" class="form-control"  placeholder="Enter email*" name="email" style="width: 400px;">
                                            @if($errors->first('email'))
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password :</label>
                                            <input type="password" class="form-control"  placeholder="Enter Phone password*" name="password" style="width: 400px;">
                                            @if($errors->first('password'))
                                            <span class="text-danger">{{$errors->first('password')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Address :</label>
                                            <input type="text" class="form-control"  placeholder="Enter address*" name="address" style="width: 400px;">
                                            @if($errors->first('address'))
                                            <span class="text-danger">{{$errors->first('address')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Gender :</label>
                                            <input type="radio" name="gender" value="Nam"> Male
                                            <input type="radio" name="gender" value="Nữ"> Female
                                            <input type="radio" name="gender" value="Khác"> Other
                                        </div>
                                        <div class="form-group">
                                           <label for="sel1">Department :</label>
                                           <select class="form-control" id="department" name="department" style="width: 400px;">
                                                <option></option>
                                                @foreach($de as $d)
                                                <option value="{{$d->id}}">{{$d->department_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                           <label for="sel1">Role :</label>
                                           <select class="form-control" id="sel1" name="role" style="width: 400px;"> 
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 480px;margin: auto;padding-left: 50px;">
                                       <div class="form-group" style="width: 480px;margin: auto;padding-left: 50px;">
                                            <label for="exampleInputFile">Avatar :</label>
                                            <div class="img">
                                            <img id="preview" src="{{asset('images/ImageDefault.png')}}" class="img-responsive">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" id="image" name="image"  onchange="encodeImageFileAsURL(this)">
                                                @if($errors->first('image'))
                                                <span class="text-danger">{{$errors->first('image')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone number :</label>
                                            <input type="number" class="form-control"  placeholder="Enter Phone number*" name="phone" >
                                            @if($errors->first('phone'))
                                            <span class="text-danger">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Larary :</label>
                                            <input type="number" class="form-control"  placeholder="Enter Phone larary*" name="larary">
                                            @if($errors->first('larary'))
                                            <span class="text-danger">{{$errors->first('larary')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Date of birth : </label>
                                            <input type="text" class="form-control"   name="dob" placeholder="YYYY-mm-dd">
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
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        <!-- /.panel-body -->
        </div>
    <!-- /.panel -->
    </div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
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
        $.get("/admin/ajax-department/"+iddepartment,function(data){
            $("#position").html(data);
        });
    });
});
</script>
@endsection