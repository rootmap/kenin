
@extends("admin.layout.master")
@section("title","Edit Room")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Room</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('room/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('room/create')}}">Create New </a></li>
              <li class="breadcrumb-item active">Edit / Modify</li>
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
            <h3 class="card-title">Edit / Modify Room</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('room/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('room/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('room/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('room/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('room/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="room_size">Room SIze</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->room_size)){
                            ?>
                            value="{{$dataRow->room_size}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Room Size" id="room_size" name="room_size">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="room_name">Room Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->room_name)){
                            ?>
                            value="{{$dataRow->room_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Room Name" id="room_name" name="room_name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="room_price">Room Price</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->room_price)){
                            ?>
                            value="{{$dataRow->room_price}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Room Price" id="room_price" name="room_price">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Room Quantity</label>
                                  <select class="form-control select2" style="width: 100%;"  id="room_quantity" name="room_quantity">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="1"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1">1</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="2"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2">2</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="3"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3">3</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="4"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4">4</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="5"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5">5</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="6"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6">6</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="7"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7">7</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="8"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8">8</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="9"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9">9</option>
            <option 
                    <?php 
                    if($dataRow->room_quantity=="10"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="10">10</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="room_feature">Room Feature</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Comma (,) Separated Feature" id="room_feature" name="room_feature"><?php 
                                if(isset($dataRow->room_feature)){
                                    
                                    echo $dataRow->room_feature;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="room_service">Room Service</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Comma (,) Separated Services" id="room_service" name="room_service"><?php 
                                if(isset($dataRow->room_service)){
                                    
                                    echo $dataRow->room_service;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Room Photo</label>
                                    <!-- <label for="customFile">Choose Room Photo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="room_photo" name="room_photo">
                                      <input type="hidden" value="{{$dataRow->room_photo}}" name="ex_room_photo" />
                                      <label class="custom-file-label" for="customFile">Choose Room Photo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->room_photo))
                                    @if(!empty($dataRow->room_photo))
                                        <img class="img-thumbnail" src="{{url('upload/room/'.$dataRow->room_photo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Room Status</label>
        
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
              <a class="btn btn-danger" href="{{url('room/edit/'.$dataRow->id)}}">
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

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

@endsection
        