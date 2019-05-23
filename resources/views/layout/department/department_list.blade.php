@extends('master')
@section('title','List')
@section('pagecss')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                    <th><a  class="btn btn-primary" data-toggle="modal" data-target="#add-width-modal" id="adddepartment">Add</a></th>
                    @endif
                    <th><a href="admin/export-department-list-to-excel" class="btn btn-info" id="exportData">Export to excel</a></th>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Department</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Quantity</th>
                                @if(Auth::user()->role==1)
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Department</th>
                                <th rowspan="1" colspan="1">Quantity</th>
                                @if(Auth::user()->role==1)
                                <th rowspan="1" colspan="1">Action</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($dep as $d)
                            <tr class="odd">
                                <td class="  sorting_1">{{$loop->iteration}}</td>
                                <td class=" "><li style="text-decoration: none;"><a href="admin/position-list/{{$d->id_department}}.html" >
                                <?php
                                $department=\App\Department::where('id',$d->id_department)->first();
                                echo $department->department_name;
                                ?> 
                                </a></li></td>
                                <td class=" ">{{$d->quantity}}</td>
                                @if(Auth::user()->role==1)
                                <td class=" ">

                                    <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{!! URL::route('admin.deleteDepartment')!!}" data-id="{{$d->id_department}}" data-target="#delete-width-modal">Delete</a>

                                    <a  class="btn btn-info waves-effect waves-light remove-record " data-toggle="modal" data-url="{!! URL::route('admin.editDepartment', $d->id_department) !!}" data-id="{{$d->id_department}}" data-target="#edit-width-modal">Edit</a>


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
                                 <li class="prev disabled"><a href="#">← Previous</a>
                                 </li>
                                 <li class="active"><a href="#">{{$dep->links()}}</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div><!-- /.box-body -->
     </div><!-- /.box -->
 </div>
</div>
<!-- add department -->
<form action="{{route('admin.addDepartment')}}"  class="add-record-model" method="post">
    @csrf
    <div id="add-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Add Department</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="department_name" name="department_name" value="" class="form-control"  placeholder="Enter Department*">
                </div>
                <div class="modal-body">
                    <input type="text" id="position" name="position" value="" class="form-control"  placeholder="Enter Position*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Delete Model -->
<form action="{{route('admin.deleteDepartment', $d->id_department)}}"  class="remove-record-model" method="post">
    @csrf
    <div id="delete-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Department</h4>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Edit Model -->
<form action="{{route('admin.editDepartment', $d->id_department)}}"  class="edit-record-model" method="post">
    @csrf
    <div id="edit-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Department</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="department_name" name="department_name" value="<?php $depa=\App\Department::where('id',$d->id_department)->first();
                        echo $depa->department_name;
                     ?>" class="form-control"  placeholder="Enter Department*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('pagejs')
<script type="text/javascript">
    $(document).ready(function(){
        $('#exportData').on('click', function{
            $.ajax({
                url:'/admin/export-department-list-to-excel',
                type:'GET',

            }).done(function(){
                alert('Suscessfully !');
            });
        });
    });
    $(document).ready(function(){
        $('#adddepartment').click(function(){
            var department_name=$('#department_name').val();
            var position=$('#position').val();
            //console.log(department_name);
            $.ajax({
                type:'POST',
                url:'<?php echo url('admin/add-department'); ?>',
                data:{'department_name':department_name,'position':position},
                success:function(data){
                    //
                }
            });
        });
    });
$(document).ready(function(){
    $('.remove-record').click(function() {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        /*var token = CSRF_TOKEN;
        $(".remove-record-model").attr("action",url);
        $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
        $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
        $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    });

    $('.remove-data-from-delete-form').click(function() {
        $('body').find('.remove-record-model').find( "input" ).remove();
    });
    $('.modal').click(function() {
         //$('body').find('.remove-record-model').find( "input" ).remove();
    });*/
    $.ajax({
        type:'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:url,
        data:{'id':id},
        success:function(data){
            //
        }

    });
});
$(document).ready(function(){
    $('.edit-record').click(function() {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var token = CSRF_TOKEN;
        $(".edit-record-model").attr("action",url);
        $('body').find('.edit-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
        $('body').find('.edit-record-model').append('<input name="_method" type="hidden" value="DELETE">');
        $('body').find('.edit-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    });

    $('.remove-data-from-delete-form').click(function() {
        $('body').find('.edit-record-model').find( "input" ).remove();
    });
   
});
</script>
@endsection