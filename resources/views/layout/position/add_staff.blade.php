@extends('master')
@section('title','Staff management')
@section('content')
<div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fullname :</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter fullname*" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email :</label>
                                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email*" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Address :</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter address*" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone number :</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone number*" name="phone">
                                        </div>
                                        <div class="form-group">
 											 <label for="sel1">Position:</label>
  											<select class="form-control" id="sel1" name="position_name">
  											  <option>1</option>
  											</select>
										</div>
										<div class="form-group">
 											 <label for="sel1">Role :</label>
  											<select class="form-control" id="sel1" name="role">
  											  <option>1</option>
  											</select>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image :</label>
                                            <input type="file" id="exampleInputFile" name="image">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Date of birth : </label>
                                            <input type="date" class="form-control"  disabled="" name="dob">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Larary :</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter larary*" name="larary">
                                        </div>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>
@endsection