@php
$defaultImg = Auth::user()->image == null ? asset('images/avatarDefault.jpeg') : Auth::user()->image;
@endphp
<!-- Left side column. contains the logo and sidebar -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<aside class="left-side sidebar-offcanvas">                
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset($defaultImg)}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->fullname}} </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Home </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Department</span>
                    <i class="fa pull-right fa-angle-left"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{route('admin.departmentList')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Department List</a></li>
                    
                </ul>
            </li>
            <li >
                <a href="{{route('admin.userList')}}">
                 <i class="fa fa-th"></i> <span>User List</span> 
             </a>
         </li>
         @if(Auth::user()->role==1)
         <li class="treeview">
            <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Statistics</span>
                <i class="fa pull-right fa-angle-left"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('CheckoutListPerMonth')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>All Staff List</a></li>
                <li><a href="{{route('admin.statisticPersonal')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Personal</a></li>

            </ul>
        </li>
        @elseif(Auth::user()->role==0)
        <li >
            <a href="{{route('admin.statisticPersonal')}}">
             <i class="fa fa-th"></i> <span>Statistics</span> 
         </a>
     </li>
     @endif

     <li>
        <a href="{{route('admin.mailbox')}}">
            <i class="fa fa-envelope"></i> <span>Mail</span>
            <!-- <small class="badge pull-right bg-yellow">12</small> -->
        </a>
    </li>
    <li >
        <a href="{{route('admin.log')}}">
            <i class="fa fa-edit"></i> <span>Blog</span>
        </a>
    </li>
    <li>
     <div class="btn-group" style="width: 150px; align-items: center;">
        <button type="button" class="btn btn-warning">Action</button>
        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu" style="background-color: #f39c12 ;">
            <?php
            $date=date('Y-m-d');
            $check=DB::table('tblcheckin')
            ->join('tblstatistic','tblcheckin.id_statist','=','tblstatistic.id')
            ->where('tblstatistic.id_staff',Auth::user()->id)
            ->where('tblcheckin.check_date',$date)
            ->first();
            if(!isset($check))
            {
                ?>
                <li><a   data-url="{!! URL::route('admin.checkin') !!}" data-id="{{Auth::user()->id}}" id="btncheckin" class="btncheckin
                    ">Checkin</a></li>
                    <?php
                }elseif(isset($check)&&$check->status==0){
                    ?>
                    <li><a  data-url="{!! URL::route('admin.checkout') !!}" data-id="{{Auth::user()->id}}" id="btncheckout" class="btncheckout">Checkout</a></li>
                    <?php
                }
                ?>


                @if(Auth::user()->role==1)
                <li><a  data-target="#addMember" data-toggle="modal" >Add new Member</a></li>
                @endif
            </ul>
        </div>
    </li>
</ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- checkin -->
<!-- <form action="{{route('admin.checkin')}}"  class="remove-record-model" method="post">
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title" style="color: blue;text-align: center;"><i class="fa fa-fw fa-check-square-o"></i>Checkin  </h4>
             </div>
             <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Start hours:</span>
                        <input type="time" class="form-control" id="start_hour" name="start_hour">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Finish hours:</span>
                        <input type="time" class="form-control" id="finish_hour" name="finish_hour">
                    </div>
                </div>

            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-danger" data-dismiss="modal"  ></i>Cancel</button>

                <button type="submit" class="btn btn-primary pull-left" id="checkin"></i> OK</button>
            </div>
        </div>
    </div>
</div>
</form> -->
<!-- Add member -->
<div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Add member </h4>
            </div>
            <form action="{{route('admin.addMember')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Email:</span>
                            <input name="email" id="email" type="text" class="form-control" placeholder="Email*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  >Cancel</button>
                    <button type="submit" class="btn btn-primary pull-left" onclick="alert('Are you sure ?');"> OK</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>
@section('pagejs')
<script type="text/javascript">
    $(document).ready(function(){
        $('.btncheckin').click(function(){
            var id=$(this).attr('data-id');
            var start_hour=moment().format('HH:mm');
            swal({
              title: "Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                //alert('success');
                 //swal("Checkin!", "Your imaginary file has been deleted.", "success");
                $.ajax({
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"<?php echo url('/admin/post-checkin'); ?>",
                    data:{'id':id,'start_hour':start_hour},
                    success:function(data){
                        if(data['success']){
                            swal("Checkin!", "Successfully!", "success");
                        }
                    }
                });
                
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
        });
    });
    //Checkout
    $('.btncheckout').click(function(){
        var finish_hour=moment().format('HH:mm');
        swal({
              title: "Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                //alert('success');
                 //swal("Checkin!", "Your imaginary file has been deleted.", "success");
                $.ajax({
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"<?php echo url('/admin/post-checkout'); ?>",
                    data:{'finish_hour':finish_hour},
                    success:function(data){
                        if(data['success']){
                            swal("Checkout!", "Successfully!", "success");
                        }
                    }
                });
                
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });

</script>
@endsection
