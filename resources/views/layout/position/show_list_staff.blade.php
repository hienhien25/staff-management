@extends('master')
@section("title","Staff List")
@section('content')
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
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Fullname</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Role</th>
                                @if(Auth::user()->role==1)
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Fullname</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Role</th>
                                @if(Auth::user()->role==1)
                                <th rowspan="1" colspan="1">Action</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($sh as $s)
                            <tr class="odd">
                                <td class="  sorting_1">{{$loop->iteration}}</td>
                                <td class=" ">{{$s->fullname}}</td>
                                <td class=" ">{{$s->email}}</td>
                                <td class=" ">
                                    @if($s->role==0)
                                    <?php echo "User"; ?>
                                    @elseif($s->role==1)
                                    <?php echo "Admin"; ?>
                                    @endif
                                </td>
                                @if(Auth::user()->role==1)
                                <td class=" ">
                                    <a href="admin/edit-staff/{{$s->id}}.html" class="btn btn-info">Edit</a>
                                    <a href="#" class="button" data-id="{{$s->id}}">Delete</a>
                                    <a href="admin/profile/{{$s->id}}.html" class="btn btn-primary">Profile</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-6">
                           <div class="dataTables_paginate paging_bootstrap">
                            {{$sh->links()}}
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
  $(document).on('click ','.button',function(e){
    e.preventDefault();
    var id=$(this).data('id');
    var url="http://staff-manage.local/admin/delete-staff/"+id;
   // console.log(url);
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
            url: url,
            data: {id:id},
            success: function (data) {
                    //
            }         
        });
    });
});
</script>
@endsection