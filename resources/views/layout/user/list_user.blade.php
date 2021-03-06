@extends('master')
@section('title','User List')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    @if(Auth::user()->role==1)
                    <th><a href="{{route('admin.user.addStaff')}}" class="btn btn-primary">Add</a></th>
                    @endif
                    <th><a href="" class="btn btn-info">Export to excel</a></th>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Full name</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Password</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Role</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Full name</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Password</th>
                                <th rowspan="1" colspan="1">Role</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                        </tfoot>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($user as $u)
                            <tr class="odd" >
                                <td class="  sorting_1">{{$loop->iteration}}</td>
                                <td class=" ">{{$u->fullname}}</td>
                                <td class=" ">{{$u->email}}</td>
                                <td class=" ">{{$u->password}}</td>
                                @if(Auth::user()->role==0)
                                <td>
                                    @if($u->role==1)
                                    <?php echo "Admin";?>
                                    @else
                                    <?php echo "User";?>
                                    @endif
                                </td>
                                @elseif(Auth::user()->role==1)
                                <td >
                                    <div class="form-group" style="width:100px;" id="role" class="role" >
                                        <select class="form-control" id="uright" name="uright"  style="width:85px;" data-id="{{$u->id}}" onchange="myFunction({{$u->id}})">
                                            <option value="0" id="user" @if($u->role==0){{"selected"}}@endif>User</option>
                                            <option value="1" id="admin" @if($u->role==1){{"selected"}}@endif>Admin</option>
                                        </select>
                                    </div>
                                </td>
                                @endif
                                <td class=" " style="width:200px;">
                                        <a href="admin/edit-staff/{{$u->id}}.html" class="btn btn-info">Update</a>
                                        <!-- <input type="hidden" name="idpos" value="{{$u->id}}"/>
                                        <input type="hidden" name="request_name" value="delete_position"/> -->
                                        @if(Auth::user()->role==1)
                                        <a  class="btn btn-danger" data-id="{{$u->id}}">Delete</a>
                                        @endif
                                </td>
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-6">
                         <div class="dataTables_paginate paging_bootstrap">
                          <ul class="pagination">
                            {{$user->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
</div>
@endsection
@section('pagejs')
<script type="text/javascript">
    function myFunction(id)
    {
        //alert(id);
        var idrole=document.getElementById("uright").value;;
        //var iduser=document.getElementById("uright").getAttribute('data-id');
        //alert(iduser);
        $.ajax({
            type:'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'<?php echo url('/admin/change-uright'); ?>',
            data:{'idrole':idrole,'id':id},
            success:function(data){
                alert('Đã thực hiện thay đổi quyền !');
            }

        });
    }
    $(document).on('click ','.btn-danger',function(e){
    e.preventDefault();
    var id=$(this).data('id');
    var url="http://staff-manage.local/admin/delete-staff";
    console.log(url);
    swal({
        title: "Are you sure!",
        type: "error",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes!",
        showCancelButton: true,
    },
    function() {
        $.ajax({
            type: "POST",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            data: {id:id},
            success: function (data) {
                if(data['success'])
                {
                    setTimeout(function () { location.reload(1); }, 1000);
                    alert('Deleted!');
                }
            }         
        });
    });
});
    
</script>
@endsection