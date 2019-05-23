@extends('master')
@section('title','Edit')
@section('content')
@php
$defaultImg = $st->image == null ? asset('images/ImageDefault.png') : $st->image;
@endphp
<input type="hidden" value="{{asset($defaultImg)}}" id="defaultImage">
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="admin/post-edit-staff/{{$st->id}}.html" method="post" enctype="multipart/form-data">
                            @csrf
                            <table style="width:100%;">
                                <tr>
                                    <td style="width: 580px; margin: auto;padding: auto;">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fullname :</label>
                                            <input type="text" class="form-control"  placeholder="Enter fullname*" name="fullname" style="width: 400px;" value="{{$st->fullname}}">
                                            @if($errors->first('fullname'))
                                            <span class="text-danger">{{$errors->first('fullname')}}</span><br/>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email :</label>
                                            <input type="text" class="form-control"  placeholder="Enter email*" name="email" style="width: 400px;" value="{{$st->email}}" >
                                            @if($errors->first('email'))
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                       <!--  <div class="form-group">
                                            <label for="exampleInputEmail1">Password :</label>
                                            <input type="password" class="form-control"  placeholder="Enter Phone password*" name="password" style="width: 400px;" value="{{$st->password}}">
                                            @if($errors->first('password'))
                                            <span class="text-danger">{{$errors->first('password')}}</span>
                                            @endif
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Address :</label>
                                            <input type="text" class="form-control"  placeholder="Enter address*" name="address" style="width: 400px;" value="@if(isset($std)){{$std->address}}@endif" >
                                            @if($errors->first('address'))
                                            <span class="text-danger">{{$errors->first('address')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Gender :</label>
                                            <input type="radio" name="gender" value="Nam" @if(isset($std)) @if($std->gender=='Nam'){{"checked"}}@endif @endif> Male
                                            <input type="radio" name="gender" value="Nữ"@if(isset($std)) @if($std->gender=='Nữ'){{"checked"}}@endif @endif> Female
                                            <input type="radio" name="gender" value="Khác"@if(isset($std)) @if($std->gender=='Khac'){{"checked"}}@endif @endif > Other
                                        </div>
                                        <div class="form-group">
                                         <label for="sel1">Department :</label>
                                         <select class="form-control" id="department" name="department" style="width: 400px;">
                                            <option></option>
                                            @foreach($de as $d)
                                            <option value="{{$d->id}}" @if($st->id_department==$d->id)<?php echo "selected";?>@endif>{{$d->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(Auth::user()->role==1)
                                    <div class="form-group">
                                     <label for="sel1">Role :</label>
                                     <select class="form-control" id="sel1" name="role" style="width: 400px;"> 
                                        <option value="0" @if($st->role==0)<?php echo "selected";?>@endif >User</option>
                                        <option value="1"  @if($st->role==1)<?php echo "selected";?>@endif>Admin</option>
                                    </select>
                                </div>
                                @endif
                            </td>
                            <td style="width: 480px;margin: auto;padding-left: 50px;">
                             <div class="form-group" style="width: 480px;margin: auto;padding-left: 50px;">
                                <label for="exampleInputFile">Avatar :</label>
                                <div class="img">
                                 <img id="preview" src="{{asset($defaultImg)}}" class="img-responsive">
                             </div>
                             <div class="form-group">
                                 <input type="file" name="image" onchange="encodeImageFileAsURL(this, 'preview')">
                             </div>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Phone number :</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone number*" value="@if(isset($std)){{$std->phone}}@endif" name="phone">
                            @if($errors->first('phone'))
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Larary :</label>
                            <input type="number" class="form-control"  placeholder="Enter Phone larary*" name="larary" value="@if(isset($std)){{$std->larary}}@endif">
                            @if($errors->first('larary'))
                            <span class="text-danger">{{$errors->first('larary')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Date of birth : </label>
                            <input type="date" class="form-control" value="@if(isset($std)){{$std->dob}}@endif" name="dob" id="dob">
                            @if($errors->first('dob'))
                            <span class="text-danger">{{$errors->first('dob')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                           <label for="sel1">Position:</label>
                           <select class="form-control" id="position" name="position">
                            <option></option>
                            @foreach($pos as $p)
                            <option value="{{$p->id}}" @if($posi->id==$p->id)<?php echo "selected"; ?>@endif>{{$p->position_name}}</option>
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
   function encodeImageFileAsURL(element, deploySelector) {
            var file = element.files[0];
            if(file == undefined){
                $('#' + deploySelector).attr('src', $('#defaultImage').val());
                return false;
            }
            var reader = new FileReader();
        }
</script>
@endsection