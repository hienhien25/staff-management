@extends('master')
@section("title","List Position")
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
                    <th><a href="{{route('admin.addPosition')}}" class="btn btn-primary">Add</a></th>
                    @endif
                    <th><a href="" class="btn btn-info">Export to excel</a></th>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Position</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Description</th>
                                @if(Auth::user()->role==1)
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Position</th>
                                <th rowspan="1" colspan="1">Description</th>
                                @if(Auth::user()->role==1)
                                <th rowspan="1" colspan="1">Action</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($pos as $p)
                            <tr class="odd">
                                <td class="  sorting_1">{{$loop->iteration}}</td>
                                <td class=" "><li><a href="admin/staff-list/{{$p->id}}.html"> {{$p->position_name}}</a></li></td>
                                <td class=" ">{{$p->description}}</td>
                                @if(Auth::user()->role==1)
                                <td class=" ">
                                    <form method="POST" class="form-delete" action="admin/delete-position/{{$p->id}}.html ">
                                        @csrf
                                        <a href="admin/edit-position/{{$p->id}}.html" class="btn btn-info">Edit</a>
                                        <input type="hidden" name="idpos" value="{{$p->id}}"/>
                                        <input type="hidden" name="request_name" value="delete_position"/>
                                        <a href="admin/delete-position/{{$p->id}}.html" class="btn btn-danger" id="delete">Delete</a>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-6">
                           <div class="dataTables_paginate paging_bootstrap">
                              <ul class="pagination">
                                {{$pos->links()}}
                            </ul>
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
    $(document).ready(function(){
        $('.btn-danger').click(function(){
            $(this).parent().submit();
            return false;
        });
        $('.form-delete').submit(function(){
         /*swal({
            title: "Are you sure you want to delete ?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm){
              swal("Deleted!", "Your imaginary file has been deleted!", "success");
              
          } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
          });*/
          if(!confirm('Are you sure you want to delete !')){
            return false;
        }
        $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');
        return true;

    });
        $('.btn-info').click(function(){
          $(this).addClass('editMode');
        });

        $(".btn-info").focusout(function(){
          $(this).removeClass("editMode");
          var id = this.id;
          var split_id = id.split("_");
          var field_name = split_id[0];
          var edit_id = split_id[1];
          var value = $(this).text();

          $.ajax({
           url: '/admin/edit-position/"+id+".html',
           type: 'post',
           data: { field:field_name, value:value, id:edit_id },
           success:function(response){
            console.log('Save successfully');
        }
         });

        });

    });
</script>
@endsection