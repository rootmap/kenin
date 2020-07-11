@extends('front-end.layout.master_blank')
@section('css')
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');

        .product-card {
            /* width: 380px; */
            position: relative;
            box-shadow: 0 2px 7px #dfdfdf;
            margin: 50px auto;
            background: #fafafa;
        }

        .badge {
            position: absolute;
            left: 0;
            top: 20px;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 700;
            background: red;
            color: #fff;
            padding: 3px 10px;
        }

        .product-tumb {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 300px;
            padding: 50px;
            background: #f0f0f0;
        }

        .product-tumb img {
            max-width: 100%;
            max-height: 100%;
        }

        .product-details {
            padding: 30px;
        }

        .product-catagory {
            display: block;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #ccc;
            margin-bottom: 18px;
        }

        .product-details h4 a {
            font-weight: 500;
            display: block;
            margin-bottom: 18px;
            text-transform: uppercase;
            color: #363636;
            text-decoration: none;
            transition: 0.3s;
        }

        .product-details h4 a:hover {
            color: #fbb72c;
        }

        .product-details p {
            font-size: 15px;
            line-height: 22px;
            margin-bottom: 18px;
            color: #999;
        }

        .product-bottom-details {
            overflow: hidden;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .product-bottom-details div {
            float: left;
            width: 50%;
        }

        .product-price {
            font-size: 18px;
            color: #fbb72c;
            font-weight: 600;
        }

        .product-price small {
            font-size: 80%;
            font-weight: 400;
            text-decoration: line-through;
            display: inline-block;
            margin-right: 5px;
        }

        .product-links {
            text-align: right;
        }

        .product-links a {
            display: inline-block;
            margin-left: 5px;
            color: #e1e1e1;
            transition: 0.3s;
            font-size: 17px;
        }

        .product-links a:hover {
            color: #fbb72c;
        }







        
        .alert>.start-icon {
            margin-right: 0;
            min-width: 20px;
            text-align: center;
        }

        .alert>.start-icon {
            margin-right: 5px;
        }

        .greencross
        {
        font-size:18px;
            color: #25ff0b;
            text-shadow: none;
        }

        .alert-simple.alert-success
        {
        border: 1px solid rgba(36, 241, 6, 0.46);
            background-color: rgba(7, 149, 66, 0.12156862745098039);
            box-shadow: 0px 0px 2px #259c08;
            color: #0ad406;
        text-shadow: 2px 1px #00040a;
        transition:0.5s;
        cursor:pointer;
        }
        .alert-success:hover{
        background-color: rgba(7, 149, 66, 0.35);
        transition:0.5s;
        }
        .alert-simple.alert-info
        {
        border: 1px solid rgba(6, 44, 241, 0.46);
            background-color: rgba(7, 73, 149, 0.12156862745098039);
            box-shadow: 0px 0px 2px #0396ff;
            color: #0396ff;
        text-shadow: 2px 1px #00040a;
        transition:0.5s;
        cursor:pointer;
        }

        .alert-info:hover
        {
        background-color: rgba(7, 73, 149, 0.35);
        transition:0.5s;
        }

        .blue-cross
        {
        font-size: 18px;
            color: #0bd2ff;
            text-shadow: none;
        }

        .alert-simple.alert-warning
        {
            border: 1px solid rgba(241, 142, 6, 0.81);
            background-color: rgba(220, 128, 1, 0.16);
            box-shadow: 0px 0px 2px #ffb103;
            color: #ffb103;
            text-shadow: 2px 1px #00040a;
        transition:0.5s;
        cursor:pointer;
        }

        .alert-warning:hover{
        background-color: rgba(220, 128, 1, 0.33);
        transition:0.5s;
        }

        .warning
        {
            font-size: 18px;
            color: #ffb40b;
            text-shadow: none;
        }

        .alert-simple.alert-danger
        {
        border: 1px solid rgba(241, 6, 6, 0.81);
            background-color: rgba(220, 17, 1, 0.16);
            box-shadow: 0px 0px 2px #ff0303;
            color: #ff0303;
            text-shadow: 2px 1px #00040a;
        transition:0.5s;
        cursor:pointer;
        }

        .alert-danger:hover
        {
            background-color: rgba(220, 17, 1, 0.33);
        transition:0.5s;
        }

        .danger
        {
            font-size: 18px;
            color: #ff0303;
            text-shadow: none;
        }

        .alert-simple.alert-primary
        {
        border: 1px solid rgba(6, 241, 226, 0.81);
            background-color: rgba(1, 204, 220, 0.16);
            box-shadow: 0px 0px 2px #03fff5;
            color: #03d0ff;
            text-shadow: 2px 1px #00040a;
        transition:0.5s;
        cursor:pointer;
        }

        .alert-primary:hover{
        background-color: rgba(1, 204, 220, 0.33);
        transition:0.5s;
        }

        .alertprimary
        {
            font-size: 18px;
            color: #03d0ff;
            text-shadow: none;
        }

        .square_box {
            position: absolute;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            border-top-left-radius: 45px;
            opacity: 0.302;
        }

        .square_box.box_three {
            background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            opacity: 0.059;
            left: -80px;
            top: -60px;
            width: 500px;
            height: 500px;
            border-radius: 45px;
        }

        .square_box.box_four {
            background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
            opacity: 0.059;
            left: 150px;
            top: -25px;
            width: 550px;
            height: 550px;
            border-radius: 45px;
        }

        .alert:before {
            content: '';
            position: absolute;
            width: 0;
            height: calc(100% - 44px);
            border-left: 1px solid;
            border-right: 2px solid;
            border-bottom-right-radius: 3px;
            border-top-right-radius: 3px;
            left: 0;
            top: 50%;
            transform: translate(0,-50%);
            height: 20px;
        }

        .fa-times
        {
        -webkit-animation: blink-1 2s infinite both;
                    animation: blink-1 2s infinite both;
        }


        /**
        * ----------------------------------------
        * animation blink-1
        * ----------------------------------------
        */
        @-webkit-keyframes blink-1 {
        0%,
        50%,
        100% {
            opacity: 1;
        }
        25%,
        75% {
            opacity: 0;
        }
        }
        @keyframes blink-1 {
        0%,
        50%,
        100% {
            opacity: 1;
        }
        25%,
        75% {
            opacity: 0;
        }
        }

        
        *, *:before, *:after {
            box-sizing: border-box;
        }

        .wrapper{
        background-color: #a9e5e5;
            padding-right: 1em;
            padding-left: 1em;
        }

        header{
            height: 64px;
            color:#fff;
            text-align: center;
            background: linear-gradient(to right, #ff9966, #ff5e62);
        }

        header h2{
            font-size: 1.8em;
            margin-top: 0;
            padding-top: .8em;
        }

        .wrapper{
            width: 90%;
            margin: 0 auto;
            padding-bottom: 0;
        }

        .info{
            text-align: center;
        }

        .info h3, fieldset legend{
        /* 	color: #444444; */
        }

        .info h3{
            margin-top: 0;
        font-size: 2.5em;
        }

        .info p{
            font-size: .85em;
            border-bottom: 4px solid rgba(45,57,69);
            padding-bottom: 1em;
            margin-bottom: 0;
        }

        form{
            border-top: 2px solid rgba(45,57,69);
            margin-top: 2px;
            padding-top: 1em;
        }

        fieldset{
            border: none;
            padding: 0;
            margin-top: 1em;
            margin-bottom: 1em;
            padding-top:1em; 
            padding-bottom:1em;
        }

        fieldset legend{
            font-size: 1.65em;
            font-weight: bold;
            padding-bottom: .75em;
        }

        .contact-info label{
            display: block;
            padding-bottom: .65em;
        font-size: 1em;
        }

        .newsletter label{
        font-size: 1.25em;
        }

        .contact-info input , select , textarea{
            box-shadow: 0 0 1px ;
            width: 100%;
            height: 3em;
            background-color: #fff;
            outline: none;
            border:none;
            border-radius: 5px;
            border-color: #fff;
            text-indent: 10px;
            transition: border-color .4s ease-in-out;
        }

        textarea{
            height: 85px;
            padding-top:10px;
        }

        .contact-info input:focus , select:focus , textarea:focus{
            border: 2px solid #46698B;
            border-radius: 0;
        }

        #name:focus,
        #email:focus{
            border: 2px solid #FF7463;
        }

        [type="submit"]{
            width: 100%;
        /* 	background-color: #4EBBB5; */
        /*   background-color: #f8f8e7; */
        background-color: #eeeec6;
            height: 60px;
            border: none;
            border-radius: 5px;
            color: #444444;
        font-size: 1.25em;
        }

        [type="submit"]:hover{
        opacity: .8;
        }

        .newsletter [type="checkbox"]{
            transform: scale(1.4);
        }

        ::placeholder{
            text-align: right;
            padding-right: 1em;
        }

        .footer p{
            padding-top: 1em;
            padding-bottom: 1em;
            text-align: center;
            margin: 0;
        }

        @media(min-width: 760px){

            .wrapper{
                max-width: 685px;
            }
            
            .info h3{
                font-size: 2em;
                letter-spacing: 1px;
            }

            .info p{
                font-size: 1.1em;
            }

            .contact-info label{
                display: inline-block;
                width: 20%;
            }

            .contact-info input , select{
                width: 78%;
            }

            .newsletter .checkboxes p{
                padding-top: 2px;
                padding-bottom: 2px;
            }
        }

        @media(min-width:1024px){

            .wrapper{
                width: 90%;
                max-width: 950px;
            }

            .contact-info label{
                display: inline-block;
                width: 26%;
            }

            .contact-info input , select{
                width: 72%;
            }

            .contact-info p , .newsletter p{
                margin-top: .5em;
                margin-bottom: .5em;
            }

            form{
                display: flex;
                justify-content: space-between;
            }

            .container{
                display: flex; 
                flex-direction: column; 
                min-width: 340px;
                height: 500px;
                justify-content: space-around;
            }

            fieldset{
                margin-right: 0;
                margin-left: 0;
            }

            .contact-info{
                width: 55%;
            }

            .newsletter{
                width: 41%;
            }

            form{
                padding-top: 1em;
            }
        }

    </style>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <section style="margin-top: 50px;">
        


                <div class="w-container benefits " style="margin-top:0px;">
  
                        <div class="w-col">
                            <div class="product-card" style="margin: 5px;">
                                <div class="badge">Available</div>
                                <div class="product-tumb">
                                    <img src="{{asset('upload/room/'.$roomData->room_photo)}}" alt="">
                                </div>
                                <div class="product-details">
                                    <span class="product-catagory">{{$roomData->room_size}}</span>
                                    <h4><a href="">{{$roomData->room_name}}</a></h4>
                                    <p>
                                        <?php 
                                            $feature=$roomData->room_feature;    
                                            $featureArray=explode(",",$feature);
                                            $k=1;
                                            foreach ($featureArray as $key => $val) {
                                                ?>
                                                <i class="fa fa-check" aria-hidden="true"></i> {{$val}} 
                                                <?php 
                                                //if($k==5){ break; } 
                                                $k++;
                                            }
                                        ?>
                                    </p>
                                    <p>
                                        <?php 
                                            $room_service=$roomData->room_service;    
                                            $room_serviceArray=explode(",",$room_service);
                                            $k=1;
                                            foreach ($room_serviceArray as $key => $val) {
                                                ?>
                                                <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{$val}} 
                                                <?php
                                                //if($k==5){ break; } 
                                                $k++;
                                            }
                                        ?>
                                    </p>
                                </div>

                                

                                <div class="w-container">
                                    <div class="info">
                                        <h3 style="margin-bottom: 0px;">Confirm Your Booking</h3>
                                        <p>Fillup your detail to confirm your booking.</p>
                                    </div>
                                    <form action="#" method="GET">
                                        <fieldset class="contact-info benefits" style="margin-top: 0px;">
                                    <div class="w-col">
                                        <p>
                                            <label for="name">Room Quantity</label>   
                                            <select name="room_quantity">
                                                <option value="">Choose Room Quantity</option>
                                                @for ($i = 1; $i <= $roomData->room_quantity; $i++)
                                                <option value="{{$i}}">{{$i}} Room</option>
                                                @endfor
                                            </select>
                                        </p>
                                    </div>
                                    <div class="w-col">
                                        <p>
                                            <label for="name">Full Name</label>   
                                            <input type="text" name="full_name" placeholder="Required" title="Please fill out this field"> 
                                        </p>
                                    </div>
                                    <div class="w-col">
                                        <p>
                                            <label for="name">Phone</label>   
                                            <input type="text" name="phone" placeholder="Required" title="Please fill out this field"> 
                                        </p>
                                    </div>
                                    <div class="w-col">
                                        <p>
                                            <label for="name">Email Address</label>   
                                            <input type="text" name="email_address" placeholder="Required" title="Please fill out this field"> 
                                        </p>
                                    </div>
                                    <div class="w-col">
                                        <p>
                                            <label for="name">Address</label>   
                                            <input type="text" name="address" placeholder="Required" title="Please fill out this field"> 
                                        </p>
                                        
                                    </div>
                                        </fieldset>

                                        
                                    </form>
                                    <div class="w-col" style="text-align: right; ">
                                        <button style="margin: 0 auto;"  type="button" class="main-book-now-button confirm-booking w-button">Confirm Booking</button>
                                    </div>
                                </div>

                                <!-- Start Form Start -->
                                   
                                <!-- Start Form End -->




                            </div>
                        </div>
          
                </div>
        
    
                    
                        

                        
                
    </section>    
@endsection
@section('js')
    <script>
      var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
      $(document).ready(function(){
          $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");

          $(".confirm-booking").click(function(){

            

              Swal.showLoading ();
              var full_name=$("input[name='full_name']").val();
              var phone=$("input[name='phone']").val();
              var email_address=$("input[name='email_address']").val();
              var address=$("input[name='address']").val();
              var room_quantity=$("select[name='room_quantity']").val();
              var arrival="{{$arrival}}";
              var departure="{{$departure}}";
              var adult="{{$adult}}";
              var children="{{$children}}";
              var room="{{$room}}";

              if(room_quantity.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Choose Room Quantity!!!</h5>'
                  });
                  return false;
              }

              if(full_name.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Type Full Name!!!</h5>'
                  });
                  return false;
              }

              if(phone.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Type Your Phone Number !!!</h5>'
                  });
                  return false;
              }

              if(email_address.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Type Your Email Address !!!</h5>'
                  });
                  return false;
              }

              if(address.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Type Your Address !!!</h5>'
                  });
                  return false;
              }

              $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "{{url('booking')}}",
                    'data': { 
                        'customer_name': full_name, 
                        'customer_phone': phone, 
                        'customer_email': email_address, 
                        'customer_address': address, 
                        'room': room, 
                        'room_quantity': room_quantity, 
                        'arrival_date': arrival, 
                        'departure_date': departure, 
                        'adults': adult, 
                        'children': children, 
                        '_token': csrftLarVe, 
                    },
                    'success': function(data) {
                        console.log("Completing Sales : " + data);
                        
                        if(data.status == 0)
                        {
                            Swal.fire({
                                icon: 'success',
                                title: '<h3 class="text-success">Thank You</h3>',
                                html: '<h5>' + data.msg + '</h5>'
                            });

                            $("input[name='full_name']").val("");
                            $("input[name='phone']").val("");
                            $("input[name='email_address']").val("");
                            $("input[name='address']").val("");
                            $("select[name='room_quantity']").val();

                            setTimeout(() => {
                                window.location.href="{{url('booking')}}/"+arrival+"/"+departure+"/"+adult+"/"+children;
                            }, 2000);
                        }
                        else
                        {
                            Swal.fire({
                                icon: 'error',
                                title: '<h3 class="text-danger">Warning</h3>',
                                html: '<h5>' + data.msg + '!!!</h5>'
                            });
                        }
                        
                    }
                });

              return false;

              

              //alert('working');
          });

      });

        
    </script>
@endsection