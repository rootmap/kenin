
@extends("admin.layout.master")
@section("title","Create New Rental Booking")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Rental Booking</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('rentalbooking/list')}}">Rental Booking Data</a></li>
              <li class="breadcrumb-item active">Create New Rental Booking</li>
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
            <h3 class="card-title">Create New Rental Booking</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('rentalbooking/list')}}"> Data <i class="fas fa-table"></i></a></li>
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
          <form action="{{url('rentalbooking')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Rental</label>
                                  <select class="form-control select2" style="width: 100%;"  id="rental_id" name="rental_id">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_RentalService))    
                                            @if(count($dataRow_RentalService)>0)
                                                @foreach($dataRow_RentalService as $RentalService)
                                                    <option value="{{$RentalService->id}}">{{$RentalService->name}}</option>
                                                    
                                                @endforeach
                                            @endif
                                        @endif 
                                        
                                  </select>
                                </div>
                            </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rental_price">Rental Price</label>
                        <input type="text" readonly class="form-control" value="0" placeholder="Enter Price" id="rental_price" name="rental_price">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rent_start_date_time">Rent Start Date Time</label>
                        <input type="text" class="form-control dateTimePick" placeholder="Choose Start Date Time" id="rent_start_date_time" name="rent_start_date_time">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="rent_end_date_time">Rent End Date Time</label>
                        <input type="text" class="form-control dateTimePick" placeholder="Choose End Date Time" id="rent_end_date_time" name="rent_end_date_time">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" placeholder="Enter Customer Name" id="customer_name" name="customer_name">
                      </div>
                    </div>
 
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Customer Phone" id="customer_phone" name="customer_phone">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_email">Customer Email</label>
                        <input type="text" class="form-control" placeholder="Enter Customer Email" id="customer_email" name="customer_email">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Booking Method</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_method" name="booking_method">
                                    
        <option value="">Please select</option>
            <option 
            value="On Spot">On Spot</option>
            <option 
            value="On Arrival">On Arrival</option>
            <option 
            value="Done With Booking">Done With Booking</option>
            <option 
            value="Free">Free</option>
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Booking Status</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_status" name="booking_status">
                                    
        <option value="">Please select</option>
            <option 
            value="Pending">Pending</option>
            <option 
            value="Confirm">Confirm</option>
            <option 
            value="Cancel">Cancel</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                           
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" class="btn btn-primary saveRentalBook" onclick="javascript:loadPayment();"><i class="fas fa-save"></i> Submit</button>
              <button type="submit" class="savInfo" style="display: none;"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('rentalbooking/create')}}"><i class="far fa-times-circle"></i> Reset</a>
            </div>


            <div class="modal fade" id="modal-md">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-credit-card"></i> Enter Card Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="departure_date">Card Number</label>
                          <input type="text" class="form-control" placeholder="Enter Card Number" id="cc-number" name="cc-number">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="departure_date">Card Holder Name</label>
                          <input type="text" class="form-control" placeholder="Enter Card Holder Name" id="cc-name" name="cc-name">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="departure_date">Card CVC</label>
                          <input type="password" class="form-control" placeholder="Enter Card CVC" id="cc-cvc" name="cc-cvc">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="departure_date">Expire Month</label>
                          <select class="form-control" id="cc-month" name="cc-month">
                              <option value="">Select Month</option>
                              @for ($i=1; $i<=12; $i++)
                              <option value="{{strlen($i)==1?'0'.$i:$i}}">{{strlen($i)==1?'0'.$i:$i}}</option>
                              @endfor
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="departure_date">Expire Year</label>
                          <select class="form-control" id="cc-year" name="cc-year">
                            <option value="">Select Year</option>
                            @for ($i=date('Y'); $i<=date('Y')+10; $i++)
                            <option value="{{strlen($i-2000)==1?'0'.($i-2000):($i-2000)}}">{{strlen($i)==1?'0'.$i:$i}}</option>
                            @endfor
                        </select>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" value="0" name="paid_status" />

                    
                    
                    
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary capture-payment"> Take/Capture Payment </button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

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
    <link rel="stylesheet" href="{{url('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
@endsection
        
@section("js")
    <script src="{{url('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{url('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
    var chargePayment = "{{url('rentalbooking/capture/payment')}}";

    function refreshSerial(){
        var r=1;
        $.each($(".crud-item"),function(key,row){
            $(this).attr("id","tr"+r);
            $(this).find("td:first").html(r);
            r++;
        });
    }

    function getTotalBook(){
      var total=0;
      $('body').find('.price_book').each(function(key,row){
          total+=($(this).val()-0);
      });
      
      console.log('total',total);

      $("#totalMadePay").html(total);
      $("input[name=amount_paid]").val(total);
    }


    function addmore(){
        $("tr[class^='crud-item']:last").after($("tr[class^='crud-item']:last").clone());
        
        var item=$(".crud-item").length;
        refreshSerial();
        $("tr[class^='crud-item']:last").children('td:eq(2)').children().val(0);
    }

    function deleteRow(place){
        var item=$(".crud-item").length;
        if(item>1)
        {
            var itemID=$(place).parent().parent().attr("id");
            $("#"+itemID).remove()
        }
        refreshSerial(); 
    }

    function loadPayment(){
        $("#modal-md").modal('show');
    }

    function swalErrorMsg(msg) {
        
        Swal.fire({
            icon: 'error',
            title: '<h3 class="text-danger">Warning</h3>',
            html: '<h5>' + msg + '!!!</h5>'
        });
        return false;

    }

    function swalSuccessMsg(msg) {
        Swal.fire({
            icon: 'success',
            title: '<h3 class="text-success">Thank You</h3>',
            html: '<h5>' + msg + '</h5>'
        });
    }

    var rentalService=<?=json_encode($dataRow_RentalService)?>;
    $(document).ready(function(){
        $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");
        getTotalBook();
        $(".select2").select2();

        $('body').on('change', '.price_book', function() {
          getTotalBook();
        });

        //saveRentalBook

        $('body').on('change', '#booking_method', function() {
            var booking_method=$(this).val();
            if(booking_method=="On Spot" || booking_method=="On Arrival")
            {
                $(".saveRentalBook").html('<i class="fas fa-credit-card"></i> Capture Payment & Save Rental Booking');
            }
            else
            {
                $(".saveRentalBook").html('<i class="fas fa-save"></i> Save Rental Booking');
            }

        });


        $('body').on('change', '#rental_id', function() {
            var rental_id=$(this).val();
            if(rental_id.length>0)
            {
                

              var htPrice=0;
              $.each(rentalService,function(key,row){
                  if(row.id==rental_id)
                  {
                      console.log('price',row.price);
                      htPrice=row.price;
                  }
              });

              $("#rental_price").val(htPrice);

            }

        });



        $('body').on('click', '.capture-payment', function() {

                var cc_number=$("input[name=cc-number]").val(); 
                var cc_name=$("input[name=cc-name]").val(); 
                var cc_cvc=$("input[name=cc-cvc]").val(); 
                var cc_month=$("select[name=cc-month]").val(); 
                var cc_year=$("select[name=cc-year]").val(); 

                var rental_id=$("#rental_id").val();
                if(rental_id.length==0)
                {
                    swalErrorMsg("Select Rental Service Required!!!."); 
                }

                var rental_price=$("#rental_price").val();
                if(rental_price==0)
                {
                    swalErrorMsg("Select Valid Rental Service!!!."); 
                }

                var amount_paid=rental_price; 

                if(cc_number.length==0){ swalErrorMsg("Card Number Required!!!."); return false; }
                if(cc_name.length==0){ swalErrorMsg("Card Holder Name Required!!!.");  return false; }
                if(cc_cvc.length==0){ swalErrorMsg("Card CVC Required!!!.");  return false; }
                if(cc_month.length==0){ swalErrorMsg("Card Month Required!!!.");  return false; }
                if(cc_year.length==0){ swalErrorMsg("Card Year Required!!!.");  return false; }

                Swal.showLoading();

                $.ajax({
                        async: true,
                        type: "POST",
                        global: true,
                        dataType: "json",
                        url: chargePayment,
                        data: {
                          cc_number: cc_number,
                          cc_name: cc_name,
                          cc_cvc: cc_cvc,
                          cc_month: cc_month,
                          cc_year: cc_year,
                          amount_paid: amount_paid,
                          _token: csrftLarVe
                        },
                        success: function(res) {
                            console.log('Success', res);
                            Swal.hideLoading();

                            if(res.respstat=="A" && res.resptext=="Approval"){ 
                                swalSuccessMsg("Payment Captured Successfully, Please wait saving your info."); 
                                $("input[name=paid_status]").val(1);
                                setTimeout(() => {
                                  $(".savInfo").click();
                                }, 2000);

                                return true;
                                 
                            }
                            else if(res.respstat!="A"){ 
                                swalErrorMsg(res.resptext); 
                                return false; 
                            }
                            else
                            {
                                swalErrorMsg("Something Went wrong, Please try capture again."); return false;
                            }
                    
                        },
                        error: function(reject) {
                            swalErrorMsg('Something went wrong, please try again later.');
                            return false;
                    
                            console.log('Error', reject.status);
                            /* window.location.href = window.location.href; */
                        }
                });

            

        });




    });

    $('.dateTimePick').daterangepicker({
      timePicker: true,
      singleDatePicker: true,
      timePickerIncrement: 5,
      locale: {
        format: 'YYYY-MM-DD hh:mm a'
      }
    })
    </script>

@endsection
        