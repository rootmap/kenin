
@extends("admin.layout.master")
@section("title","Edit Top Menu")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Top Menu</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('topmenu/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('topmenu/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Top Menu</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('topmenu/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('topmenu/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('topmenu/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('topmenu/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('topmenu/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="menu_name">Menu Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->menu_name)){
                            ?>
                            value="{{$dataRow->menu_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Menu Name" id="menu_name" name="menu_name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="menu_link">Menu Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->menu_link)){
                            ?>
                            value="{{$dataRow->menu_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Menu Link" id="menu_link" name="menu_link">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Enter Menu Position</label>
                                  <select class="form-control select2" style="width: 100%;"  id="menu_position" name="menu_position">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="1"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1">1</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="2"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2">2</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="3"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3">3</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="4"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4">4</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="5"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5">5</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="6"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6">6</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="7"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7">7</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="8"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8">8</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="9"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9">9</option>
            <option 
                    <?php 
                    if($dataRow->menu_position=="10"){
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
              <!-- radio -->
              <div class="form-group">
              <label>Choose Menu Status</label>
        
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
              <a class="btn btn-danger" href="{{url('topmenu/edit/'.$dataRow->id)}}">
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

@endsection
        