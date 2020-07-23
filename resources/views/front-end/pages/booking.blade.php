@extends('front-end.layout.master_blank')
@section('css')
    <style type="text/css">
        
    </style>
    <link href="{{asset('css/semantic.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/semantic.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.payment.js')}}" type="text/javascript"></script>
    <script>
        /**
        * paymentForm
        *
        * A plugin that validates a group of payment fields.  See jquery.payment.js
        * Adapted from https://gist.github.com/Air-Craft/1300890
        */
        
        // if (!window.L) { window.L = function () { console.log(arguments);} } // optional EZ quick logging for debugging

        (function( $ ){
            
            /**
            * The plugin namespace, ie for $('.selector').paymentForm(options)
            * 
            * Also the id for storing the object state via $('.selector').data()  
            */
            var PLUGIN_NS = 'paymentForm';

            var Plugin = function ( target, options )  { 
                this.$T = $(target); 
                this._init( target, options ); 

                /** #### OPTIONS #### */
            this.options= $.extend(
                    true,               // deep extend
                    {
                        DEBUG: false
                    },
                    options
                );
                
                this._cardIcons = {
                    "visa"          : "visa icon",
                    "mastercard"    : "mastercard icon",
                    "amex"          : "american express icon",
                    "dinersclub"    : "diners club icon",
                    "discover"      : "discover icon",
                    "jcb"           : "japan credit bureau icon",
                    "default"       : "credit card alternative icon"
                };
                
                return this; 
            }

            /** #### INITIALISER #### */
            Plugin.prototype._init = function ( target, options ) { 
                var base = this;
                
                base.number = this.$T.find("[data-payment='cc-number']");
                base.exp = this.$T.find("[data-payment='cc-exp']");
                base.cvc = this.$T.find("[data-payment='cc-cvc']");
                base.brand = this.$T.find("[data-payment='cc-brand']");
                base.onlyNum = this.$T.find("[data-numeric]");
                
                // Set up all payment fields inside the payment form
                base.number.payment('formatCardNumber').data('payment-error-message', 'Please enter a valid credit card number.');
                base.exp.payment('formatCardExpiry').data('payment-error-message', 'Please enter a valid expiration date.');
                base.cvc.payment('formatCardCVC').data('payment-error-message', 'Please enter a valid CVC.');
                base.onlyNum.payment('restrictNumeric');
                
                // Update card type on input
                base.number.on('input', function() {
                    base.cardType = $.payment.cardType(base.number.val());
                    var fg = base.number.closest('.ui.icon.input');            
                    if (base.cardType) {
                        base.brand.text(base.cardType);
                        // Also set an icon
                        var icon = base._cardIcons[base.cardType] ? base._cardIcons[base.cardType] : base._cardIcons["default"];
                        fg.children('i').attr( "class", icon) ;
                        //("<i class='" + icon + "'></i>");
                    } else {
                        $("[data-payment='cc-brand']").text("");
                    }
                });
                
                // Validate card number on change
                base.number.on('change', function () {
                    base._setValidationState($(this), !$.payment.validateCardNumber($(this).val()));
                });

                // Validate card expiry on change
                base.exp.on('change', function () {
                    base._setValidationState($(this), !$.payment.validateCardExpiry($(this).payment('cardExpiryVal')));
                });
                
                // Validate card cvc on change
                base.cvc.on('change', function () {
                    base._setValidationState($(this), !$.payment.validateCardCVC($(this).val(), base.cardType));
                });   
            };

            /** #### PUBLIC API (see notes) #### */
            Plugin.prototype.valid = function () {
                var base = this;
                
                var  num_valid 	= $.payment.validateCardNumber(base.number.val());
                var  exp_valid 	= $.payment.validateCardExpiry(base.exp.payment('cardExpiryVal'));
                var  cvc_valid 	= $.payment.validateCardCVC(base.cvc.val(), base.cardType);
                
                base._setValidationState(base.number, !num_valid);
                base._setValidationState(base.exp, !exp_valid);
                base._setValidationState(base.cvc, !cvc_valid);
                
                return num_valid && exp_valid && cvc_valid;
            }
        
            /** #### PRIVATE METHODS #### */
            Plugin.prototype._setValidationState = function(el, erred) {
                var fg = el.closest('.field');
                fg.toggleClass('error', erred).toggleClass('', !erred);
                fg.find('.payment-error-message').remove();
                if (erred) {
                    fg.append("<span class='ui pointing red basic label payment-error-message'>" + el.data('payment-error-message') + "</span>");
                }
                return this;
            }  
            
            /**
            * EZ Logging/Warning (technically private but saving an '_' is worth it imo)
            */    
            Plugin.prototype.DLOG = function () 
            {
                if (!this.DEBUG) return;
                for (var i in arguments) {
                    console.log( PLUGIN_NS + ': ', arguments[i] );    
                }
            }
            Plugin.prototype.DWARN = function () 
            {
                this.DEBUG && console.warn( arguments );    
            }


        /*###################################################################################
        * JQUERY HOOK
        ###################################################################################*/

            /**
            * Generic jQuery plugin instantiation method call logic 
            * 
            * Method options are stored via jQuery's data() method in the relevant element(s)
            * Notice, myActionMethod mustn't start with an underscore (_) as this is used to
            * indicate private methods on the PLUGIN class.   
            */    
            $.fn[ PLUGIN_NS ] = function( methodOrOptions ) {
                if (!$(this).length) {
                    return $(this);
                }
                var instance = $(this).data(PLUGIN_NS);
                    
                // CASE: action method (public method on PLUGIN class)        
                if ( instance 
                        && methodOrOptions.indexOf('_') != 0 
                        && instance[ methodOrOptions ] 
                        && typeof( instance[ methodOrOptions ] ) == 'function' ) {
                    
                    return instance[ methodOrOptions ]( Array.prototype.slice.call( arguments, 1 ) ); 
                        
                        
                // CASE: argument is options object or empty = initialise            
                } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {

                    instance = new Plugin( $(this), methodOrOptions );    // ok to overwrite if this is a re-init
                    $(this).data( PLUGIN_NS, instance );
                    return $(this);
                
                // CASE: method called before init
                } else if ( !instance ) {
                    $.error( 'Plugin must be initialised before using method: ' + methodOrOptions );
                
                // CASE: invalid method
                } else if ( methodOrOptions.indexOf('_') == 0 ) {
                    $.error( 'Method ' +  methodOrOptions + ' is private!' );
                } else {
                    $.error( 'Method ' +  methodOrOptions + ' does not exist.' );
                }
            };
        })(jQuery);

        /* Initialize validation */
        var payment_form = $('#payment-form').paymentForm();

        $('#payment-form').on('submit', function(){
            event.preventDefault();
            var valid = $(this).paymentForm('valid');
            if (valid){
                console.log('CC info is good!');
                stripe();
            }else{
                console.log('Badman Cardfaker');
            }
        });

        $("select[name=country]").change(function(){
            var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
            var country_id=$(this).val();
            Swal.showLoading ();
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "{{url('region')}}",
                'data': { 
                    'country_id': country_id, 
                    '_token': csrftLarVe, 
                },
                'success': function(data) {
                    console.log("Completing Sales : " + data);
                    var htmlOpt='<option value="0">Select Region</option>';
                    $.each(data,function(key,row){
                        htmlOpt+='<option value="'+row.code+'">'+row.name+'</option>';
                    });

                    $("#region").html(htmlOpt);

                    Swal.fire({
                        icon: 'info',
                        title: '<h3 class="text-success">Select Region</h3>',
                        html: '<h5>Region Loaded Successfully.</h5>'
                    });

                    // if(data.status == 0)
                    // {
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: '<h3 class="text-success">Thank You</h3>',
                    //         html: '<h5>' + data.msg + '</h5>'
                    //     });

                    // }
                    // else
                    // {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: '<h3 class="text-danger">Warning</h3>',
                    //         html: '<h5>' + data.msg + '!!!</h5>'
                    //     });
                    // }
                    
                }
            });
        });

        function initError(msg){
            Swal.fire({
                icon: 'error',
                title: '<h3 class="text-danger">Warning</h3>',
                html: '<h5>'+msg+'!!!</h5>'
            });
        }

        $(".captureProfile").click(function(e){

            Swal.showLoading();
            var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
            var cardNumber=$("input[name=cc-number]").val();
            var cardCVC=$("input[name=cc-cvc]").val();
            var cardExp=$("input[name=cc-exp]").val();
            var cardHolderName=$("input[name=cc-name]").val();
            var cardZipCode=$("input[name=zip-code]").val();
            var cardCountry=$("select[name=country]").val();
            var cardRegion=$("select[name=region]").val();
            var cardCity=$("input[name=city]").val();
            var cardAddress=$("input[name=cc-address]").val();
            var cardemail=$("input[name=email]").val();
            var cardphone=$("input[name=phone]").val();

            Swal.showLoading();

            if(cardNumber.length==0){ initError('Card number required.'); return false; }
            if(cardCVC.length==0){ initError('Card CVC required.'); return false; }
            if(cardExp.length==0){ initError('Card Expire Month/Year required.'); return false; }
            if(cardHolderName.length==0){ initError('Card Holder Name required.'); return false; }
            if(cardZipCode.length==0){ initError('Enter zip code / postal.'); return false; }
            if(cardCountry.length==0){ initError('Choose your country.'); return false; }
            if(cardRegion.length==0){ initError('Choose your region.'); return false; }
            if(cardCity.length==0){ initError('Enter your city.'); return false; }
            if(cardAddress.length==0){ initError('Enter your address.'); return false; }
            if(cardemail.length==0){ initError('Enter your Email.'); return false; }
            if(cardphone.length==0){ initError('Enter your Phone.'); return false; }

            $(this).hide();
            $(".hideProfile").show();
            Swal.showLoading();
            Swal.showLoading();
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "{{url('cpe/profile/create')}}",
                'data': { 
                    'card_number': cardNumber, 
                    'cardCVC': cardCVC, 
                    'expiry': cardExp, 
                    'card_holder_name': cardHolderName, 
                    'postal': cardZipCode, 
                    'country': cardCountry, 
                    'region': cardRegion, 
                    'city': cardCity, 
                    'address': cardAddress, 
                    'email': cardemail, 
                    'phone': cardphone, 
                    'reservation_date': "{{date('d/m/Y H:i:s A')}}", 
                    'arrival_date': "{{$arrival}}", 
                    'departure_date':"{{$departure}}", 
                    'adults': "{{$adult}}", 
                    'children': "{{$children}}", 
                    '_token': csrftLarVe, 
                },
                'error':function(res){
                    Swal.fire({
                        icon: 'error',
                        title: '<h3 class="text-danger">Warning</h3>',
                        html: '<h5>Something went wrong!!!</h5>'
                    });
                },
                'success': function(data) {
                    console.log("Completing Sales : " + data);
                    Swal.hideLoading();
                    if(data.status == 1)
                    {
                        Swal.fire({
                            icon: 'success',
                            title: '<h3 class="text-success">Thank You</h3>',
                            html: '<h5>' + data.resptext + '</h5>'
                        });

                        $("input[name=cc-number]").val("");
                        $("input[name=cc-cvc]").val("");
                        $("input[name=cc-exp]").val("");
                        $("input[name=cc-name]").val("");
                        $("input[name=zip-code]").val("");
                        $("input[name=city]").val("");
                        $("input[name=cc-address]").val("");
                        $("input[name=email]").val("");
                        $("input[name=phone]").val("");

                        setTimeout(() => {
                            window.location.href="{{url('/')}}";
                        }, 5000);

                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: '<h3 class="text-danger">Warning</h3>',
                            html: '<h5>' + data.resptext + '!!!</h5>'
                        });
                    }
                    
                }
            });
        });

        
    </script>
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
        <div class="ui container">
        	<div id="mainContainer" class="ui compact basic left aligned segment" style="max-width:600px; margin:auto;">
                <div class="ui yellow inverted segment">
                	<h3 class="ui top attached tertiary basic segment">
                      Booking Available on your date range
                      <span style="float:right;">
                      	<i class="american express large icon"></i>
                        <i class="diners club large icon"></i>
                        <i class="discover large icon"></i>
                        <i class="japan credit bureau large icon"></i>
                        <i class="mastercard large icon"></i>
                        <i class="visa large icon"></i>
                      </span>
                    </h3>
                	<form class="ui payment form attached segment" id="payment-form" method="post">
                        <input style="display:none" />
                        <div class="w-container benefits " style="margin-top:0px;">
                            <div class="w-col">
                                <code class="red" style="text-align: left;">Notes : Your card will not charge now, after admin confirmation your card will be charged.</code>
                                <hr>
                            </div>
                        </div>
                        <div class="w-container benefits " style="margin-top:0px;">
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Card Number <span style="color: #f00;">*</span></label>
                                    <div class="ui icon input">
                                        <i class="credit card alternative icon"></i>
                                        <input type="tel" name="cc-number" id="cc-number" placeholder="•••• •••• •••• ••••" data-payment='cc-number'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-container benefits " style="margin-top:10px;">
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">CVC <span style="color: #f00;">*</span></label>
                                    <input type="password" name="cc-cvc" id="cc-cvc" placeholder="•••" data-payment='cc-cvc'>
                                </div>
                            </div>
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Card Expiry (MM/YYYY) <span style="color: #f00;">*</span></label>
                                    <input type="tel" name="cc-exp" id="cc-exp" placeholder="•• / ••••" data-payment='cc-exp'>
                                </div>
                            </div>
                        </div>

                        <div class="w-container benefits " style="margin-top:10px;">
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Card Holder Name <span style="color: #f00;">*</span></label>
                                    <input type="text" name="cc-name" id="cc-name" placeholder="Enter Name Visible on Card" data-payment='cc-name'>
                                </div>
                            </div>
                        </div>
                        

                        <div class="w-container benefits " style="margin-top:10px;">
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Zip <span style="color: #f00;">*</span></label>
                                    <input type="tel" name="zip-code" id="zip-code" maxlength="8" placeholder="ZIP Code" data-numeric>
                                </div>
                            </div>
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Country <span style="color: #f00;">*</span></label>
                                    <select id="country" name="country">
                                        <option data-id="0" value="">Select Country</option>
                                        @isset($country)
                                            @foreach ($country as $row)
                                            <option data-id="{{$row->id}}" value="{{$row->code}}">{{$row->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                
                            </div>
                        </div>

                        <div class="w-container benefits " style="margin-top:10px;">
                            
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Region <span style="color: #f00;">*</span></label>
                                    <select id="region" name="region">
                                        <option value="">Select Region</option>
                                        @isset($region)
                                            @foreach ($region as $row)
                                            <option  value="{{$row->code}}">{{$row->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">City <span style="color: #f00;">*</span></label>
                                    <input type="text" name="city" id="city" placeholder="Enter City" data-text>
                                </div>
                            </div>
                        </div>

                        <div class="w-container benefits " style="margin-top:10px;">
                            
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Email  <span style="color: #f00;">*</span></label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email" data-text>
                                </div>
                            </div>
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">phone <span style="color: #f00;">*</span></label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Phone" data-text>
                                </div>
                            </div>
                        </div>

                        <div class="w-container benefits " style="margin-top:10px;">
                            <div class="w-col">
                                <div class="field">
                                    <label style="text-align: left;">Card Holder Address <span style="color: #f00;">*</span></label>
                                    <input type="text" name="cc-address" id="cc-address" placeholder="Enter Address" data-payment='cc-address'>
                                </div>
                            </div>
                        </div>

                        
                        

                        <div class="paybutton field" style="text-align:center; margin-top:20px;">
                            <div class="ui labeled button">
                              <button class="ui black button captureProfile" type="button" tabindex="0">
                                <i class="credit card alternative icon"></i> Submit for Booking
                              </button>
                              <button class="ui black button hideProfile" type="button" style="display: none;" tabindex="0">
                                <i class="credit card alternative icon"></i> Processing please wait...
                              </button>
                              <a class="ui basic black left pointing label">
                                $ 1
                              </a>
                            </div>
                        </div>
                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection