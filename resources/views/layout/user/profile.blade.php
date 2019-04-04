@extends('master')
@section('title','Profile')
@section('content')
<div class="user-profile">
	<div class="row">
		<div class="col-md-12">
			<div class="user-display" style="background-image: url(/assets/images/{{$pro->image}})">
				<br>
				<br>

				<div class="user-display-bottom">
					<div class="user-display-avatar">


						<img src="{{$pro->image}}" alt="NO IMAGE">
					</div>
					<div class="user-display-info">
						<div class="title">TÊN NHÂN VIÊN </div>
						<div class="name">{{$pr->fullname}}</div>

					</div>
					<div class="row user-display-details">
						<div class="col-xs-4">
							<div class="title">QUYỀN </div>
							<div class="counter">{{$pr->role}}</div>
						</div>
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
			<div id="home" class="tab-pane fade in active">
				<div class="col-md-12">
					<div class="user-info-list panel panel-default">
						<div class="panel panel-flat">
							<div class="panel-heading panel-heading-divider"><b>THÔNG TIN NHÂN VIÊN</b></div>
							<div class="panel-body">
								<table class="no-border no-strip skills">
									<tbody class="no-border-x no-border-y">
										<tr class="">

											<td class="item">Họ tên<span class="icon s7-gift"></span></td>
											<td>
												<span id="ctl02_ctl00_inpFullName">{{$pr->fullname}}</span></td>

												<td><span class="red">&nbsp; &nbsp; <i class="fa fa-hand-o-right" style="visibility: hidden;" id="hd11"></i>
													<span id="LastName"></span>

													<span id="FirstName"></span>
												</span></td>
											</tr>
											<tr>

												<td class="item">Ngày sinh<span class="icon s7-gift"></span></td>
												<td>
													<span id="ctl02_ctl00_inpDOB_">{{$pro->dob}}</span></td>
													<td><span class="red">&nbsp; &nbsp; <i class="fa fa-hand-o-right" style="visibility: hidden;" id="hd12"></i>
														<span id="DOB"></span>
													</span></td>
												</tr>
												<tr>

													<td class="item">Giới tính : <span class="icon s7-gift"></span></td>
													<td>
														<input type="radio" name="gender" value="Nam" @if($pro->gender==Nam){{checked}}@endif > Male<br>
														<input type="radio" name="gender" value="Nữ" @if($pro->gender==Nữ ){{checked}}@endif > Female<br>
														<input type="radio" name="gender" value="Khác" @if($pro->gender==Khác ){{checked}}@endif> Other
													</td>
													</tr>
													<tr>
														<td class="item">Địa chỉ<span class="icon s7-global"></span></td>
														<td>
															<span id="ctl02_ctl00_lblBirthPlace">{{$pro->address}}</span>
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
							<div class="panel panel-flat">
								<div class="panel-heading panel-heading-divider"><b>BẢNG CẬP NHẬT</b></div>
								<div class="panel-body">
									<table class="no-border no-strip skills">
										<tbody class="no-border-x no-border-y">
											<tr>
												<td>
													<div class="form-group">
														<label for="usr">Full Name:</label>
														<input type="text" class="form-control" id="usr" name="fullname" value="{{$pr->fullname}}">
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
											<tr>
												<td>
													<div class="form-group">
														<label for="usr">Password:</label>
														<input type="password" name="password" class="form-control" id="usr" value="{{$pr->password}}">
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="usr">Phone number:</label>
														<input type="number" class="form-control" name="phone" id="usr" value="{{$pr->phone}}">
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="usr">Address :</label>
														<input type="text" name="address" class="form-control" id="usr" value="{{$pr->address}}">
													</div>
												</td>
											</tr>
											<tr>
												<div class="form-group">
													<div class="col-sm-offset-0 col-sm-10">
														<a onclick="return checksubmit();" id="ctl02_ctl00_lbcontacinfo" class="btn btn-primary" href="javascript:__doPostBack('ctl02$ctl00$lbcontacinfo','')">
														Cập nhật thông tin liên hệ</a>
														<button type="button" class="btn btn-space btn-default" onclick="return Back();">Quay lại</button>
													</div>
												</div>
											</tr>
										</tbody>
									</table>
								</div>
							</div>               
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
															<input name="phone" type="text" value="{{$pro->phone}}" id="phone" class="form-control input-xs" placeholder="Nhập vào điện thoại liên hệ">
														</div>
													</div>
													<div class="form-group">
														<label for="firstName" class="col-sm-2 control-label">
															Email liên hệ
														</label>
														<div class="col-sm-10">
															<input name="email" type="text" id="email" value="{{$pro->email}}" class="form-control input-xs" placeholder="Nhập vào email liên hệ">
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-offset-0 col-sm-10">
															<a onclick="return checksubmit();" id="ctl02_ctl00_lbcontacinfo" class="btn btn-primary" href="javascript:__doPostBack('ctl02$ctl00$lbcontacinfo','')">
															Cập nhật thông tin liên hệ</a>
															<button type="button" class="btn btn-space btn-default" onclick="return Back();">Quay lại</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				@endsection