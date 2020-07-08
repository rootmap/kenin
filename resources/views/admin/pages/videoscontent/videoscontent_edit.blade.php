
@extends("admin.layout.master")
@section("title","Edit Videos Content")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Videos Content</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Videos Content</li>
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
            <h3 class="card-title">Edit / Modify Videos Content</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('videoscontent/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="section_sub_title">Section Sub Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->section_sub_title)){
                            ?>
                            value="{{$dataRow->section_sub_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Section Sub Title" id="section_sub_title" name="section_sub_title">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="section_title">Section Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->section_title)){
                            ?>
                            value="{{$dataRow->section_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Section Title" id="section_title" name="section_title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="section_button_text">Section Button Text</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->section_button_text)){
                            ?>
                            value="{{$dataRow->section_button_text}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Section Button Text" id="section_button_text" name="section_button_text">
                      </div>
                    </div>
  
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="section_button_url">Section Button URL</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->section_button_url)){
                            ?>
                            value="{{$dataRow->section_button_url}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Section Button URL" id="section_button_url" name="section_button_url">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Section Foreground Image</label>
                                    <!-- <label for="customFile">Choose Section Foreground Image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="section_foreground_image" name="section_foreground_image">
                                      <input type="hidden" value="{{$dataRow->section_foreground_image}}" name="ex_section_foreground_image" />
                                      <label class="custom-file-label" for="customFile">Choose Section Foreground Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->section_foreground_image))
                                    @if(!empty($dataRow->section_foreground_image))
                                        <img class="img-thumbnail" src="{{url('upload/videoscontent/'.$dataRow->section_foreground_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Section Video Mp4</label>
                                    <!-- <label for="customFile">Choose Section Video Mp4</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="section_video_mp4" name="section_video_mp4">
                                      <input type="hidden" value="{{$dataRow->section_video_mp4}}" name="ex_section_video_mp4" />
                                      <label class="custom-file-label" for="customFile">Choose Section Video Mp4</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="{{url('upload/videoscontent/'.$dataRow->section_video_mp4)}}" class="btn btn-primary">
                                    <i class="fas fa-download"></i> 
                                    Download / Open File
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Section Video Webm</label>
                                    <!-- <label for="customFile">Choose Section Video Webm</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="section_video_webm" name="section_video_webm">
                                      <input type="hidden" value="{{$dataRow->section_video_webm}}" name="ex_section_video_webm" />
                                      <label class="custom-file-label" for="customFile">Choose Section Video Webm</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="{{url('upload/videoscontent/'.$dataRow->section_video_webm)}}" class="btn btn-primary">
                                    <i class="fas fa-download"></i> 
                                    Download / Open File
                                </a>
                            </div>
                        </div>
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Section Status</label>
        
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
              <a class="btn btn-danger" href="{{url('videoscontent/edit/'.$dataRow->id)}}">
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
@section("js")

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

@endsection
        