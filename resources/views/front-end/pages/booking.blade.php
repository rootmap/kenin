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

    </style>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <section id="dream" class="dark-section" style="padding-top: 2px;">
            <div class="benefits">
            <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625cc" style="opacity:0" class="w-col">
                @isset($slider->slider_booking_status)
                    @if ($slider->slider_booking_status=="Active")
                    <div class="booking-base w-form">
                        <form id="wf-form-Booking-Form"  autocomplete="off" method="POST" name="wf-form-Booking-Form" data-name="Booking Form" class="imputs">
                        @include('front-end.extra.search.lg')
                        @include('front-end.extra.search.xs')
                        <input type="submit" value="BOOK NOW" data-wait="One moment please..." class="main-book-now-button w-button">
                        </form>
                        <div class="success-message w-form-done">
                        <div>Thank you! Your booking details has been received!</div>
                        </div>
                        <div class="error-message w-form-fail">
                        <div>Oops! Something went wrong, please try to be more accurate.</div>
                        </div>
                    </div>
                    @endif
                @endisset
            </div>
            
            </div>

    </section>
    <section style="margin-top: 50px;">
        <?php $loop=5; $ii=1;  ?>
        @for ($i = 0; $i <$loop; $i++)

        @if ($ii==1)
        <div class="w-container benefits " style="margin-top:0px;">
        @endif

        <div class="w-small-3">
            <div class="product-card" style="margin: 5px;">
                <div class="badge">Hot</div>
                <div class="product-tumb">
                    <img src="https://i.imgur.com/xdbHo4E.png" alt="">
                </div>
                <div class="product-details">
                    <span class="product-catagory">Women,bag</span>
                    <h4><a href="">Women leather bag</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class="product-bottom-details">
                        <div class="product-price">$230.99</div>
                        <div class="product-links">
                            <a href="" style="color:#fbb72c; font-weight: bolder;"><i class="fa fa-shopping-cart"></i> Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($i==$loop && $ii==3)
            </div>
        @elseif($ii==3)
            </div>
        @endif



        <?php  
        if($ii==3){
            $ii=0;
        }
        $ii++; 
        
        ?>

        @endfor
    
                    
                        

                        
                
    </section>
    {{-- <section id="explore" class="section">
        <div class="small-width-container" style="padding-top: 39px;">
          <div class="explore-the-shelter">
                <div class="success-message">
                    <div>Thank you! Your booking details has been received!</div>
                </div>
                <div class="error-message">
                    <div>Oops! Something went wrong, please try to be more accurate.</div>
                </div>

                


          </div>
        </div>
    </section> --}}


    
@endsection