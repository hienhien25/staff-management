@extends("master")
@section('title','position')
@section('content')
<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Quick Example</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Position name :</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="" placeholder="Enter postion name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Quantity :</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity" >
                                        </div>
                                       <div class="form-group">
                                            <label>Description :</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter description"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
@endsection