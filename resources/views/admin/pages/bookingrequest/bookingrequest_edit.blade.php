
@extends("admin.layout.master")
@section("title","Edit Booking Request")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Booking Request</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bookingrequest/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('bookingrequest/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Booking Request</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('bookingrequest/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('bookingrequest/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('bookingrequest/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('bookingrequest/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('bookingrequest/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Room</label>
                                  <select class="form-control select2" style="width: 100%;"  id="room" name="room">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_Room)>0)
                                            @foreach($dataRow_Room as $Room)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->id==$Room->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$Room->id}}">{{$Room->room_name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Quantity</label>
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
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_address">Customer Address</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Customer Address" id="customer_address" name="customer_address"><?php 
                                if(isset($dataRow->customer_address)){
                                    
                                    echo $dataRow->customer_address;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="arrival_date">Arrival Date</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->arrival_date)){
                            ?>
                            value="{{$dataRow->arrival_date}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Choose Arrival Date" id="arrival_date" name="arrival_date">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="departure_date">Departure Date</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->departure_date)){
                            ?>
                            value="{{$dataRow->departure_date}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Choose Departure Date" id="departure_date" name="departure_date">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Adults</label>
                                  <select class="form-control select2" style="width: 100%;"  id="adults" name="adults">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->adults=="1"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1">1</option>
            <option 
                    <?php 
                    if($dataRow->adults=="2"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2">2</option>
            <option 
                    <?php 
                    if($dataRow->adults=="3"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3">3</option>
            <option 
                    <?php 
                    if($dataRow->adults=="4"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4">4</option>
            <option 
                    <?php 
                    if($dataRow->adults=="5"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5">5</option>
            <option 
                    <?php 
                    if($dataRow->adults=="6"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6">6</option>
            <option 
                    <?php 
                    if($dataRow->adults=="7"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7">7</option>
            <option 
                    <?php 
                    if($dataRow->adults=="8"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8">8</option>
            <option 
                    <?php 
                    if($dataRow->adults=="9"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9">9</option>
            <option 
                    <?php 
                    if($dataRow->adults=="10"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="10">10</option>
            <option 
                    <?php 
                    if($dataRow->adults=="11"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="11">11</option>
            <option 
                    <?php 
                    if($dataRow->adults=="12"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="12">12</option>
            <option 
                    <?php 
                    if($dataRow->adults=="13"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="13">13</option>
            <option 
                    <?php 
                    if($dataRow->adults=="14"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="14">14</option>
            <option 
                    <?php 
                    if($dataRow->adults=="15"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="15">15</option>
            <option 
                    <?php 
                    if($dataRow->adults=="16"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="16">16</option>
            <option 
                    <?php 
                    if($dataRow->adults=="17"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="17">17</option>
            <option 
                    <?php 
                    if($dataRow->adults=="18"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="18">18</option>
            <option 
                    <?php 
                    if($dataRow->adults=="19"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="19">19</option>
            <option 
                    <?php 
                    if($dataRow->adults=="20"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="20">20</option>
            <option 
                    <?php 
                    if($dataRow->adults=="21"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="21">21</option>
            <option 
                    <?php 
                    if($dataRow->adults=="22"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="22">22</option>
            <option 
                    <?php 
                    if($dataRow->adults=="23"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="23">23</option>
            <option 
                    <?php 
                    if($dataRow->adults=="24"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="24">24</option>
            <option 
                    <?php 
                    if($dataRow->adults=="25"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="25">25</option>
            <option 
                    <?php 
                    if($dataRow->adults=="26"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="26">26</option>
            <option 
                    <?php 
                    if($dataRow->adults=="27"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="27">27</option>
            <option 
                    <?php 
                    if($dataRow->adults=="28"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="28">28</option>
            <option 
                    <?php 
                    if($dataRow->adults=="29"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="29">29</option>
            <option 
                    <?php 
                    if($dataRow->adults=="30"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="30">30</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Children</label>
                                  <select class="form-control select2" style="width: 100%;"  id="children" name="children">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->children=="0"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="0">0</option>
            <option 
                    <?php 
                    if($dataRow->children=="1"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1">1</option>
            <option 
                    <?php 
                    if($dataRow->children=="2"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2">2</option>
            <option 
                    <?php 
                    if($dataRow->children=="3"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3">3</option>
            <option 
                    <?php 
                    if($dataRow->children=="4"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4">4</option>
            <option 
                    <?php 
                    if($dataRow->children=="5"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5">5</option>
            <option 
                    <?php 
                    if($dataRow->children=="6"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6">6</option>
            <option 
                    <?php 
                    if($dataRow->children=="7"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7">7</option>
            <option 
                    <?php 
                    if($dataRow->children=="8"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8">8</option>
            <option 
                    <?php 
                    if($dataRow->children=="9"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9">9</option>
            <option 
                    <?php 
                    if($dataRow->children=="10"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="10">10</option>
            <option 
                    <?php 
                    if($dataRow->children=="11"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="11">11</option>
            <option 
                    <?php 
                    if($dataRow->children=="12"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="12">12</option>
            <option 
                    <?php 
                    if($dataRow->children=="13"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="13">13</option>
            <option 
                    <?php 
                    if($dataRow->children=="14"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="14">14</option>
            <option 
                    <?php 
                    if($dataRow->children=="15"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="15">15</option>
            <option 
                    <?php 
                    if($dataRow->children=="16"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="16">16</option>
            <option 
                    <?php 
                    if($dataRow->children=="17"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="17">17</option>
            <option 
                    <?php 
                    if($dataRow->children=="18"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="18">18</option>
            <option 
                    <?php 
                    if($dataRow->children=="19"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="19">19</option>
            <option 
                    <?php 
                    if($dataRow->children=="20"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="20">20</option>
            <option 
                    <?php 
                    if($dataRow->children=="21"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="21">21</option>
            <option 
                    <?php 
                    if($dataRow->children=="22"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="22">22</option>
            <option 
                    <?php 
                    if($dataRow->children=="23"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="23">23</option>
            <option 
                    <?php 
                    if($dataRow->children=="24"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="24">24</option>
            <option 
                    <?php 
                    if($dataRow->children=="25"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="25">25</option>
            <option 
                    <?php 
                    if($dataRow->children=="26"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="26">26</option>
            <option 
                    <?php 
                    if($dataRow->children=="27"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="27">27</option>
            <option 
                    <?php 
                    if($dataRow->children=="28"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="28">28</option>
            <option 
                    <?php 
                    if($dataRow->children=="29"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="29">29</option>
            <option 
                    <?php 
                    if($dataRow->children=="30"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="30">30</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Booking From</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_from" name="booking_from">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->booking_from=="Online Booking"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Online Booking">Online Booking</option>
            <option 
                    <?php 
                    if($dataRow->booking_from=="Manual Booking"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Manual Booking">Manual Booking</option>
            <option 
                    <?php 
                    if($dataRow->booking_from=="Email Booking"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Email Booking">Email Booking</option>
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
                    if($dataRow->booking_status=="Canceled"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Canceled">Canceled</option>
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
              <a class="btn btn-danger" href="{{url('bookingrequest/edit/'.$dataRow->id)}}">
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
        