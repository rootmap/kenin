
@extends("admin.layout.master")
@section("title","Edit Slider")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Slider</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Slider</li>
            </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include("admin.include.msg")
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 offset-2">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit / Modify Slider</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('slider/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="slider_text">Slider Text</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Slider Text" id="slider_text" name="slider_text"><?php 
                                if(isset($dataRow->slider_text)){
                                    
                                    echo $dataRow->slider_text;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Slider Foreground Image</label>
                                    <!-- <label for="customFile">Choose Slider Foreground Image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="slider_foreground_image" name="slider_foreground_image">
                                      <input type="hidden" value="{{$dataRow->slider_foreground_image}}" name="ex_slider_foreground_image" />
                                      <label class="custom-file-label" for="customFile">Choose Slider Foreground Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->slider_foreground_image))
                                    @if(!empty($dataRow->slider_foreground_image))
                                        <img class="img-thumbnail" src="{{url('upload/slider/'.$dataRow->slider_foreground_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Slider Booking Status</label>
                                  <select class="form-control select2" style="width: 100%;"  id="slider_booking_status" name="slider_booking_status">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->slider_booking_status=="Active"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Active">Active</option>
            <option 
                    <?php 
                    if($dataRow->slider_booking_status=="Inactive"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Inactive">Inactive</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Slider Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Active"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_0" name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Inactive"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_1" name="module_status" value="Inactive">
                          <label class="form-check-label">Inactive</label>
                        </div>
                
                    </div>
                </div>
            </div>
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('slider/edit/'.$dataRow->id)}}">
                <i class="far fa-times-circle"></i> 
                Reset
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section("css")
    
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

@endsection
        