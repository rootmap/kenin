
@extends("admin.layout.master")
@section("title","Edit Rental Booking")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Rental Booking</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('rentalbooking/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('rentalbooking/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Rental Booking</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('rentalbooking/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('rentalbooking/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('rentalbooking/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('rentalbooking/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('rentalbooking/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Rental</label>
                                  <select class="form-control select2" style="width: 100%;"  id="rental_id" name="rental_id">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_RentalService)>0)
                                            @foreach($dataRow_RentalService as $RentalService)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->id==$RentalService->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$RentalService->id}}">{{$RentalService->name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rental_price">Rental Price</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->rental_price)){
                            ?>
                            value="{{$dataRow->rental_price}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Price" id="rental_price" name="rental_price">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rent_start_date_time">Rent Start Date Time</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->rent_start_date_time)){
                            ?>
                            value="{{$dataRow->rent_start_date_time}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Choose Start Date Time" id="rent_start_date_time" name="rent_start_date_time">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rent_end_date_time">Rent End Date Time</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->rent_end_date_time)){
                            ?>
                            value="{{$dataRow->rent_end_date_time}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Choose End Date Time" id="rent_end_date_time" name="rent_end_date_time">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->customer_name)){
                            ?>
                            value="{{$dataRow->customer_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Customer Name" id="customer_name" name="customer_name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->customer_phone)){
                            ?>
                            value="{{$dataRow->customer_phone}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Customer Phone" id="customer_phone" name="customer_phone">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_email">Customer Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->customer_email)){
                            ?>
                            value="{{$dataRow->customer_email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Customer Email" id="customer_email" name="customer_email">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Booking Method</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_method" name="booking_method">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->booking_method=="On Spot"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="On Spot">On Spot</option>
            <option 
                    <?php 
                    if($dataRow->booking_method=="On Arrival"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="On Arrival">On Arrival</option>
            <option 
                    <?php 
                    if($dataRow->booking_method=="Done With Booking"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Done With Booking">Done With Booking</option>
            <option 
                    <?php 
                    if($dataRow->booking_method=="Free"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Free">Free</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Booking Status</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_status" name="booking_status">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->booking_status=="Pending"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Pending">Pending</option>
            <option 
                    <?php 
                    if($dataRow->booking_status=="Confirm"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Confirm">Confirm</option>
            <option 
                    <?php 
                    if($dataRow->booking_status=="Cancel"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Cancel">Cancel</option>
                                  </select>
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
              <a class="btn btn-danger" href="{{url('rentalbooking/edit/'.$dataRow->id)}}">
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
        