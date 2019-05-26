@extends('master')
@section('title','mailbox')
@section('content')

<!-- Main content -->
<section class="content">
    <!-- MAILBOX BEGIN -->
    <div class="mailbox row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                             This is an example of having the box header within the box body -->
                                             <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
                                            <!-- Navigation - folders-->
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox (14)</a></li>
                                                    <!-- <li><a href="#"><i class="fa fa-pencil-square-o"></i> Drafts</a></li> -->
                                                    <li><a href="{{route('admin.mailbox')}}"><i class="fa fa-mail-forward"></i> Sent Mail</a></li>
                                                    <li><a href="{{route('admin.mailReceived')}}"><i class="fa fa-star"></i>Mail Received</a></li>
                                                   <!--  <li><a href="#"><i class="fa fa-folder"></i> Junk</a></li> -->
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <label style="margin-right: 10px;" class="">
                                                        <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" id="check-all" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                    </label>
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Mark as read</a></li>
                                                            <li><a href="#">Mark as unread</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Move to junk</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <form action="{{route('admin.searchMail')}}" class="text-right" method="get">
                                                        <div class="input-group">                                                            
                                                            <input type="text" class="form-control input-sm" placeholder="Enter Title *" name="keyword">
                                                            <div class="input-group-btn">
                                                                <button type="submit"  class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>                                                     
                                                    </form>
                                                </div>
                                            </div><!-- /.row -->

                                            @yield('mail')
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <!-- <div class="box-footer clearfix">
                                    <div class="pull-right">
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>
                                    </div>
                                </div> --><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->
                <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
                                <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                            </div>
                            <form action="{{route('admin.sendMail')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">TO:</span>
                                            <input name="user_recive" id="user_recive" type="text" class="form-control" placeholder="Email TO*">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Title:</span>
                                            <input name="title" id="title" type="text" class="form-control" placeholder="Title*">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="content" id="content" class="form-control" placeholder="Message*" style="height: 120px;"></textarea>
                                    </div>
                                    <div class="form-group">                                
                                        <div class="btn btn-success btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="document" accept="file_extension|image/*|media_type" multiple>
                                        </div>
                                        <p class="help-block">Max. 32MB</p>
                                    </div>

                                </div>
                                <div class="modal-footer clearfix">

                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return getConfirmation();"><i class="fa fa-times"></i> Discard</button>

                                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div>
                </div>
                @endsection
@section('pagejs')
<script type="text/javascript">
    function getConfirmation()
    {
        var retVal = confirm("Do you want to continue ?");
        if (retVal == true)
        {
            alert("User wants to continue!");
            return true;
        } 
        else
        {
            location.replace('http://staff-manage.local/admin/mailbox');
            return false;
        }
    }
</script>
@endsection