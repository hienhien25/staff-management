<!DOCTYPE html>
<html>
<head>
    <title>Update profile</title>
    <base href="{{asset('/')}}">
    @include('css')
    <script type="text/javascript">
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
</head>
<body>
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="admin/updateProfile/{{$tk}}.html" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fullname :</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter fullname*" value="" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email :</label>
                                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email*" value="" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password :</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter email*" value="" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address :</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter address*" value="" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone number :</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone number*" value="" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender :</label>
                                    <tr>

                                        <td>
                                            <input type="radio" name="gender" value="Nam" > Male
                                            <input type="radio" name="gender" value="Nữ" > Female
                                            <input type="radio" name="gender" value="Khác" > Other
                                        </td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Department :</label>
                                    <select class="form-control" id="department" name="department">
                                        @foreach($de as $d)
                                        <option value="{{$d->id}}"  >{{$d->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                 <label for="sel1">Role :</label>
                                 <select class="form-control" id="sel1">
                                   <option value="0" >User</option>
                                   <option value="1" >Admin</option>
                               </select>
                           </div>
                       </div><!-- /.box-body -->
                   </form>
               </div><!-- /.box -->

           </div><!--/.col (left) -->
           <!-- right column -->
           <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-warning">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.replace('http://staff-manage.local/admin');">×</button>
               <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                     <div class="img">

                        <img id="preview" src="images/avatarDefault.jpeg" class="img-responsive">
                    </div>

                </div>
                <br/>
                <div class="form-group">
                    <label>Avatar: </label>
                    <input type="file" name="image" onchange="encodeImageFileAsURL(this, 'preview')">
                </div>
            </div>
            <div class="form-group">
                <label>Date of birth : </label>
                <input type="date" class="form-control"  value="" name="dob">
            </div>
            <div class="form-group">
             <label for="sel1">Position:</label>
             <select class="form-control" id="position" name="position">
                @foreach($pos as $p)
                <option value="{{$p->id}}">{{$p->position_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!--/.col (right) -->
</div>
</div>
</div>
@include('js')
</body>
</html>


