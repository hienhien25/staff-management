@extends("master")
@section('title','position')
@section('content')
<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Quick Example</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Position name :</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="postion_name" placeholder="Enter postion name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Quantity :</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity" name="quantity">
                                        </div>
                                       <div class="form-group">
                                            <label>Description :</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter description" name="description"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
@endsection
@section('pagejs')
 <script type="text/javascript">
         $(document).ready(function(){
            tinymce.init({
                selector: 'textarea',
                plugins : 'advlist autolink link image lists charmap print preview'
            });
        })
</script>
@endsection