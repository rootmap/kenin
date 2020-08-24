
@extends("admin.layout.master")
@section("title","Create New Booking Request")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Booking Request</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bookingrequest/list')}}">Booking Request Data</a></li>
              <li class="breadcrumb-item active">Create New Booking Request</li>
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
            <h3 class="card-title">Create Manual Booking Request | Temporary ID : {{Session::get('booking_id')}} </h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('bookingrequest/list')}}"> Data <i class="fas fa-table"></i></a></li>
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
          <form action="{{url('bookingrequest')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                    
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
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="customer_address">Customer Address</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Customer Address" id="customer_address" name="customer_address"></textarea>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Rental Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="tr1" class="crud-item">
                                <td>1</td>
                                <td>
                                  <select id="example-select" name="rental_id[]" class="form-control rental_service" size="1">
                                    <option value="">Select Rental Services</option>
                                    @isset($rentalService)
                                        @foreach ($rentalService as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endisset
                                </select> 
                                </td>
                                <td>
                                  <input readonly type="text" id="example-text-input" class="form-control price_book" value="0" placeholder="Text" name="rental_price[]">
                                </td>
                                <td>
                                    <button type="button" onclick="deleteRow(this)" class="btn btn-warning deleteRow btn-alt btn-default"><i class="fa fa-times fa-fw"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="arrival_date">Arrival Date</label>
                        <input type="text" class="form-control dateTimePick" placeholder="Choose Arrival Date" id="arrival_date" name="arrival_date">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="departure_date">Departure Date</label>
                        <input type="text" class="form-control dateTimePick" placeholder="Choose Departure Date" id="departure_date" name="departure_date">
                      </div>
                    </div>
                </div>


                
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Adults</label>
                                  <select class="form-control select2" style="width: 100%;"  id="adults" name="adults">
                                    
        <option value="">Please select</option>
            <option 
            value="1">1</option>
            <option 
            value="2">2</option>
            <option 
            value="3">3</option>
            <option 
            value="4">4</option>
            <option 
            value="5">5</option>
            <option 
            value="6">6</option>
            <option 
            value="7">7</option>
            <option 
            value="8">8</option>
            <option 
            value="9">9</option>
            <option 
            value="10">10</option>
            <option 
            value="11">11</option>
            <option 
            value="12">12</option>
            <option 
            value="13">13</option>
            <option 
            value="14">14</option>
            <option 
            value="15">15</option>
            <option 
            value="16">16</option>
            <option 
            value="17">17</option>
            <option 
            value="18">18</option>
            <option 
            value="19">19</option>
            <option 
            value="20">20</option>
            <option 
            value="21">21</option>
            <option 
            value="22">22</option>
            <option 
            value="23">23</option>
            <option 
            value="24">24</option>
            <option 
            value="25">25</option>
            <option 
            value="26">26</option>
            <option 
            value="27">27</option>
            <option 
            value="28">28</option>
            <option 
            value="29">29</option>
            <option 
            value="30">30</option>
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Children</label>
                                  <select class="form-control select2" style="width: 100%;"  id="children" name="children">
                                    
        <option value="">Please select</option>
            <option 
            value="0">0</option>
            <option 
            value="1">1</option>
            <option 
            value="2">2</option>
            <option 
            value="3">3</option>
            <option 
            value="4">4</option>
            <option 
            value="5">5</option>
            <option 
            value="6">6</option>
            <option 
            value="7">7</option>
            <option 
            value="8">8</option>
            <option 
            value="9">9</option>
            <option 
            value="10">10</option>
            <option 
            value="11">11</option>
            <option 
            value="12">12</option>
            <option 
            value="13">13</option>
            <option 
            value="14">14</option>
            <option 
            value="15">15</option>
            <option 
            value="16">16</option>
            <option 
            value="17">17</option>
            <option 
            value="18">18</option>
            <option 
            value="19">19</option>
            <option 
            value="20">20</option>
            <option 
            value="21">21</option>
            <option 
            value="22">22</option>
            <option 
            value="23">23</option>
            <option 
            value="24">24</option>
            <option 
            value="25">25</option>
            <option 
            value="26">26</option>
            <option 
            value="27">27</option>
            <option 
            value="28">28</option>
            <option 
            value="29">29</option>
            <option 
            value="30">30</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Booking From</label>
                                  <select class="form-control select2" style="width: 100%;"  id="booking_from" name="booking_from">
                                    
        <option value="">Please select</option>
            <option 
            value="Online Booking">Online Booking</option>
            <option 
            value="Manual Booking">Manual Booking</option>
            <option 
            value="Email Booking">Email Booking</option>
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
            value="Canceled">Canceled</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                           
            </div>
            {{-- <input type="hidden" class="price_book" value="{{$bookingConfiguration->resort_daily_rent}}" /> --}}
            <input type="hidden" class="payment_json" value="" />
            <input type="hidden" class="payment_status" value="0" />
            <input type="hidden" class="temporary_id" value="{{Session::get('booking_id')}}" />
            <input type="hidden" class="amount_paid" name="amount_paid" value="0" />
            <!-- /.card-body -->

            <div class="modal fade" id="modal-md">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-credit-card"></i> Enter Card Details | Total Booking Bill $<span id="totalMadePay"></span></h5>
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

            <div class="card-footer">
              <button type="submit" style="display: none;" class="btn btn-primary saveBooking"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('bookingrequest/create')}}"><i class="far fa-times-circle"></i> Reset</a>
              <button type="button" onclick="javascript:addmore();" class="btn btn-info"><i class="fas fa-plus"></i> Add More Field</button>
              <button type="button" onclick="javascript:loadPayment();" class="btn btn-info"><i class="fas fa-credit-card"></i> Make Payment</button>
            
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
    <link rel="stylesheet" href="{{url('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    <style type="text/css">
    .hourselect option:nth-child(-n+11) {
        display: none;
    }
    
    .hourselect option:nth-child(n+19) {
        display: none;
    }
    </style>
@endsection
        
@section("js")
    <script src="{{url('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{url('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
    var chargePayment = "{{url('bookingrequest/capture/payment')}}";
    
    function diff_hours() 
    {
      var arrival_date=$('input[name=arrival_date]').val();
      var departure_date=$('input[name=departure_date]').val();
      var start = Date.parse(arrival_date); //get timestamp

      //value end
      var end = Date.parse(departure_date); //get timestamp

      totalHours = 0;
      if (start < end) {
        totalHours = Math.floor((end - start) / 1000 / 60 / 60); //milliseconds: /1000 / 60 / 60
      }
      var getDayWithFraction=(totalHours/24);
      var getClearDay=Math.floor(getDayWithFraction);
      var checkMaxFrac=getDayWithFraction-getClearDay;
      var additionalDay=0;
      if(checkMaxFrac>0)
      {
        additionalDay=1;
      }

      var totalDay=(getClearDay-0)+(additionalDay-0);

      console.log('Diff Hour =',totalDay);

      return totalDay;
    }

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
        
        console.log('total=',total);

        var totalHours=diff_hours();
        console.log('totalHours=',total);
        console.log('Clear Day = ',totalHours);
        var totalRent="{{$bookingConfiguration->resort_daily_rent}}";
        var totalRentToPay=parseFloat(totalRent*totalHours);
        console.log('totalRent * totalHours=',totalRentToPay);
        totalRentToPay+=parseFloat(total-0);
        console.log('Writing Price = ',totalRentToPay);
        $("#totalMadePay").html(totalRentToPay);
        $("input[name=amount_paid]").val(totalRentToPay);
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

        getTotalBook();
        setInterval(() => {
          getTotalBook();
        }, 5000);
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

    var rentalService=<?=json_encode($rentalService)?>;
    $(document).ready(function(){
        $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");
        getTotalBook();
        $(".select2").select2();

        $('body').on('change', '.price_book', function() {
          getTotalBook();
        });



        $('body').on('change', '.rental_service', function() {
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

              $(this).parent().parent().children('td:eq(2)').children().val(htPrice);

            }

        });

        $('body').on('click', '.capture-payment', function() {
            var temporary_id=$('input[name=temporary_id]').val();
            if(temporary_id!="")
            {
                var customer_name=$("input[name=customer_name]").val();
                var customer_phone=$("input[name=customer_phone]").val();
                var customer_email=$("input[name=customer_email]").val();
                var customer_address=$("textarea[name=customer_address]").val(); 
                var arrival_date=$("input[name=arrival_date]").val(); 
                var departure_date=$("input[name=departure_date]").val(); 
                var adults=$("select[name=adults]").val(); 
                var children=$("select[name=children]").val(); 
                var booking_from=$("select[name=booking_from]").val(); 
                var booking_status=$("select[name=booking_status]").val(); 
                var cc_number=$("input[name=cc-number]").val(); 
                var cc_name=$("input[name=cc-name]").val(); 
                var cc_cvc=$("input[name=cc-cvc]").val(); 
                var cc_month=$("select[name=cc-month]").val(); 
                var cc_year=$("select[name=cc-year]").val(); 
                var amount_paid=$("input[name=amount_paid]").val(); 

                if(customer_name.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Name Required!!!.");  return false; }
                if(customer_phone.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Phone Required!!!.");  return false; }
                if(customer_email.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Email Required!!!.");  return false; }
                if(customer_address.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Address Required!!!.");  return false; }
                if(arrival_date.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Arrival Date Required!!!.");  return false; }
                if(departure_date.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Customer Departure Date Required!!!.");  return false; }
                if(adults.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Adults Required!!!.");  return false; }
                if(children.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Children Required!!!.");  return false; }
                if(booking_from.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Booking From Required!!!.");  return false; }
                if(booking_status.length==0){ $("#modal-md").modal('hide'); swalErrorMsg("Booking Status Required!!!.");  return false; }
                if(cc_number.length==0){ swalErrorMsg("Card Number Required!!!.");  return false; }
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
                          customer_name: customer_name,
                          customer_phone: customer_phone,
                          customer_email: customer_email,
                          customer_address: customer_address,
                          arrival_date: arrival_date,
                          departure_date: departure_date,
                          adults: adults,
                          children: children,
                          booking_from: booking_from,
                          booking_status: booking_status,
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
                                setTimeout(() => {
                                    $(".saveBooking").click();
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

            }

        });




    });

    $('.dateTimePick').daterangepicker({
      
      singleDatePicker: true,
      timePickerIncrement:60,
      timePickerSeconds:false,
      maxHour:12,

      timePicker: true,
      locale: {
        format: 'YYYY-MM-DD hh:mm:ss a'
      }
    })
    </script>

@endsection
        