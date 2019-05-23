@extends('master')
@section('title','Profile')
@section('content')
<div class="user-profile" style="margin-left: 40px;">
	<div class="row">
		<div class="col-md-12">
			<div class="user-display" style="background-image: url(/assets/images/{{$pr->image}})">
				<br/>
				<div class="user-display-bottom">
					<table>
						<tr>
							<td>
								<div class="user-display-avatar">
									<img src="{{$pr->image}}" alt="NO IMAGE" style="width:80px;height: 80px;" class="img-circle">
								</div>
							</td>
							<td style="width:50px;"></td>
							<td>
								<div class="user-display-info">
									<div class="title">TÊN NHÂN VIÊN </div>
									<div class="name">{{$pr->fullname}}</div>
								</div>
							</td>
							<td style="width:50px;"></td>
							<td>
								<div class="row user-display-details">
									<div class="col-xs-4">
										<div class="title">QUYỀN </div>
										<div class="counter">@if($pr->role==1)<?php echo "Admin";?>
										@else
										<?php echo "User";?>
										@endif
									</div>
								</div>
							</td>
							<td style="width:50px;"></td>
							<td>
								<div class="user-display-info">
									<div class="title">PHÒNG BAN  </div>
									<div class="name">{{$depa->department_name}}</div>
								</div>
							</td>
							<td style="width:50px;"></td>
							<td>
								<div class="user-display-info">
									<div class="title">VỊ TRÍ  </div>
									<div class="name">{{$pos->position_name}}</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>

		</div>

	</div>

</div>

<div class="panel panel-flat">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">THÔNG TIN CÁ NHÂN</a></li>
		<li><a data-toggle="tab" href="#menu2">THÔNG TIN LIÊN HỆ</a></li>
	</ul>
</div>
<div class="row">
	<div class="tab-content1 tab-content ">
		<div id="menu2" class="tab-pane fade">
			<div class="col-md-12">
				<div class="user-info-list panel panel-default">
					<div class="panel panel-flat">
						<div class="panel-heading panel-heading-divider"><b>THÔNG TIN LIÊN HỆ</b></div>
						<div class="panel-body">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="firstName" class="col-sm-2 control-label">
										Điện thoại liên hệ
									</label>
									<div class="col-sm-10">
										<input name="phone" type="text" value="@if(isset($dp)){{$dp->phone}}@endif" id="phone" class="form-control input-xs" placeholder="Nhập vào điện thoại liên hệ">
									</div>
								</div>
								<div class="form-group">
									<label for="firstName" class="col-sm-2 control-label">
										Email liên hệ
									</label>
									<div class="col-sm-10">
										<input name="email" type="text" id="email" value="{{$pr->email}}" class="form-control input-xs" placeholder="Nhập vào email liên hệ">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-10">
										<a onclick="return checksubmit();" class="btn btn-primary" href="#">
										Cập nhật thông tin liên hệ</a>
										<button type="button" class="btn btn-space btn-default" onclick="window.history.back();">Quay lại</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="home" class="tab-pane fade in active">
			<div class="col-md-12">
				<div class="user-info-list panel panel-default">
					<div class="panel panel-flat">
						<div class="panel-heading panel-heading-divider"><b>THÔNG TIN NHÂN VIÊN</b>
						</div>
						<div class="panel-body">
							<table class="no-border no-strip skills">
								<tbody class="no-border-x no-border-y">
									<tr class="">

										<td class="item">Họ tên<span class="icon s7-gift"></span></td>
										<td>
											<span id="ctl02_ctl00_inpFullName">{{$pr->fullname}}</span>
										</td>

										<td><span class="red">&nbsp; &nbsp; <i class="fa fa-hand-o-right" style="visibility: hidden;" id="hd11"></i>
											<span id="LastName"></span>

											<span id="FirstName"></span>
										</span></td>
									</tr>
									<tr>

										<td class="item"><span class="icon s7-gift">Ngày sinh :</span></td>
										<td>
											<span id="ctl02_ctl00_inpDOB_">@if(isset($dp)){{$dp->dob}}@endif</span></td>
											<td>
												<span class="red">&nbsp; &nbsp; <i class="fa fa-hand-o-right" style="visibility: hidden;" id="hd12"></i>
													<span id="DOB"></span>
												</span>
											</td>
										</tr>
										<tr>

											<td class="item">Giới tính : <span class="icon s7-gift"></span></td>
											<td>
												<span id="ctl02_ctl00_inpFullName">@if(isset($dp)){{$dp->gender}}@endif</span>
											</td>
										</tr>
										<tr>
											<td class="item"><span class="icon s7-global">Địa chỉ :</span></td>
											<td>
												<span id="ctl02_ctl00_lblBirthPlace">@if(isset($dp)){{$dp->address}}@endif</span>
											</td>
											<td>
												<span class="red"><b>&nbsp; &nbsp; <i class="fa fa-hand-o-right" style="visibility: hidden;" id="hd2"></i>
													<span id="inpBirthPlace"></span></b>
												</span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-flat" >
					<form action="admin/profile" method="post" >
					@csrf
					<div class="panel-heading panel-heading-divider" style="padding-left: 30px;"><b>BẢNG CẬP NHẬT</b></div>
					<input type="hidden" value="{{$depa->id}}" name="department">
					<div class="panel-body" style="padding-left: 0px;margin-left: 0px;">
						<table class="no-border no-strip skills" style="padding-left: 0px;margin:30px; width: 60%;" >
							<tbody class="no-border-x no-border-y">
								<tr>
									<td>
										<div class="form-group">
											<label for="usr">Full Name:</label>
											<input type="text" class="form-control" id="usr" name="fullname" value="{{$pr->fullname}}" style="width:100%;">
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="usr">Email:</label>
											<input type="email" class="form-control" id="usr" name="email" value="{{$pr->email}}">
										</div>
									</td>
								</tr>
								<!-- <tr>
									<td>
										<div class="form-group">
											<label for="usr">Password:</label>
											<input type="password" name="password" class="form-control" id="usr" value="{{$pr->password}}">
										</div>
									</td>
								</tr> -->
								<tr>
									<td>
										<div class="form-group">
											<label for="usr">Phone number:</label>
											<input type="number" class="form-control" name="phone" id="usr" value="@if(isset($dp)){{$dp->phone}}@endif">
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="usr">Address :</label>
											<input type="text" name="address" class="form-control" id="usr" value="@if(isset($dp)){{$dp->address}}@endif">
										</div>
									</td>
								</tr>
							</tbody>

						</table>
						<div class="form-group">
							<div class="col-sm-offset-0 col-sm-10" style="padding-left: 30px;">
								<button type="submit" class="btn btn-primary" >Cập nhật thông tin </button>
								<button type="button" class="btn btn-space btn-default " onclick="window.history.back();" >Quay lại</button>
							</div>
						</div>
					</div>
				</form>
				</div>               
			</div>
		</div>
	</div>
	@endsection