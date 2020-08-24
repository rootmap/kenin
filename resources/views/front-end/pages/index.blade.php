@extends('front-end.layout.master')
@section('css')
<style type="text/css">
  .banner {
    position: relative;
    height: 100vh;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #f6f9fe;
    background-image:linear-gradient(180deg, rgba(0, 0, 0, 0.7), transparent 50%), linear-gradient(0deg, rgba(0, 0, 0, 0.4) 50%, transparent), url('{{url('upload/slider/'.$slider->slider_foreground_image)}}');
    background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.7)), color-stop(50%, transparent)), -webkit-gradient(linear, left bottom, left top, color-stop(50%, rgba(0, 0, 0, 0.4)), to(transparent)), url('{{url('upload/slider/'.$slider->slider_foreground_image)}}');
    background-position: 0px 0px, 0px 0px, 50% 32%;
    background-size: auto, auto, cover;
    background-repeat: repeat, repeat, no-repeat;
    background-attachment: scroll, scroll, scroll;
    color: #fff;
  }
  </style>
@endsection
@section('slider')
    <div class="banner-content-middle">
        <div class="wrap-banner-content">
        <h1>{{$slider->slider_text}}</h1>
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
        <a href="#dream" class="scroll-down w-inline-block">
        <div>↓</div>
        </a>
    </div>
@endsection
@section('content')
<section id="dream" class="dark-section">
    @isset($dream)
        @if ($dream->module_status=="Active")
        <div class="headline-wrap">
          <h2 class="margin-bottom">{{$dream->section_title}}</h2>
          <p class="gray">{{$dream->section_sub_title}}</p>
        </div>
        <div class="benefits">
          <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625cc" style="opacity:0" class="benefits-list">
            <div class="benefits-title">
              <div>{{$dream->section_block_one_title}}</div>
            </div>
            <div class="benefits-description">
              <p class="gray">{{$dream->section_block_one_detail}}</p>
            </div>
          </div>
          <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625d3" style="opacity:0" class="benefits-list">
            <div class="benefits-title">
              <div>{{$dream->section_block_two_title}}</div>
            </div>
            <div class="benefits-description">
              <p class="gray">{{$dream->section_block_two_detail}}</p>
            </div>
          </div>
          <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625da" style="opacity:0" class="benefits-list">
            <div class="benefits-title">
              <div>{{$dream->section_block_three_title}}</div>
            </div>
            <div class="benefits-description">
              <p class="gray">{{$dream->section_block_three_detail}}</p>
            </div>
          </div>
        </div>
        @endif
    @endisset

    <style type="text/css">
    .playpause {
        background-image:url('{{asset('images/play-vimeo.png')}}');
        background-repeat:no-repeat;
        width:30%;
        height:30%;
        position:absolute;
        left:0%;
        right:0%;
        top:0%;
        bottom:0%;
        margin:auto;
        background-size:contain;
        background-position: center;
        cursor: pointer;
        text-decoration:none;
      }

      .playpause:hover {
        opacity: 0.50;
        cursor: pointer;
      }
    </style>
    
    @isset($video)
        @if ($video->module_status="Active")
        <section id="video" class="video-section" style="background: url({{asset('upload/videoscontent/'.$video->section_foreground_image)}}); background-size:cover;">
            {{-- <div class="video-content">
                <h5 class="gray">{{$video->section_sub_title}}</h5>
                <h3>{{$video->section_title}}</h3><a href="{{url('/'.$video->section_button_url)}}" class="book-now-button w-button">{{$video->section_button_text}}</a>
            </div> --}}
            
            <div class="background-video w-background-video w-background-video-atom">
                    {{-- <video autoplay="" loop="" 
                    style="background-image:url(&quot;{{asset('upload/videoscontent/'.$video->section_foreground_image)}}&quot;)" 
                    muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover">
                        <source src="{{asset('upload/videoscontent/'.$video->section_video_mp4)}}" data-wf-ignore="true">
                        <source src="{{asset('upload/videoscontent/'.$video->section_video_webm)}}" data-wf-ignore="true">
                    </video> --}}

                    <a class="playpause"  data-fancybox href="{{$video->section_video_mp4}}"></a>
            </div>
        </section>
        @endif
    @endisset
    
    
    {{-- <div class="big-shelter-image">
      <div class="big-gradient-image"></div>
    </div> --}}
</section>
@isset($shelter)
    @if ($shelter->module_status="Active")
    <section id="explore" class="section">
      <div class="small-width-container">
        <div class="explore-the-shelter">
          <h2>{{$shelter->section_title}}</h2>
          @if (!empty($shelter->section_sub_title))
            <h5 class="gray">{{$shelter->section_sub_title}}</h5>
          @endif
          <div class="shelter-benefits">
            <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c90" style="opacity:0" class="feature">
              <p><span class="text-span-big">1<br>‍</span>{{$shelter->section_one_title}}</p>
            </div>
            <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c97" style="opacity:0" class="feature">
              <p><span class="text-span-big">2<br>‍</span>{{$shelter->section_two_title}}</p>
            </div>
            <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c9e" style="opacity:0" class="feature">
              <p><span class="text-span-big">3<br>‍</span>{{$shelter->section_three_title}}</p>
            </div>
          </div>
        </div>

        @isset($shelterPhoto)
            

        <div data-animation="slide" data-duration="500" data-infinite="1" class="gallery-slider w-slider">
          <div class="gallery-slider-mask w-slider-mask">
            @foreach ($shelterPhoto as $photo)
            <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{asset('upload/shelterphoto/'.$photo->photo)}}" srcset="{{asset('upload/shelterphoto/'.$photo->photo)}} 500w, {{asset('upload/shelterphoto/'.$photo->photo)}} 750w" sizes="(max-width: 479px) 78vw, (max-width: 767px) 28vw, 29vw" alt=""><script type="application/json" class="w-json">{
            "items": [
            {
              "type": "image",
              "_id": "{{$photo->id}}",
              "fileName": "{{$photo->photo}}",
              "origFileName": "{{$photo->photo}}",
              "width": 750,
              "height": 1000,
              "fileSize": 172622,
              "url": "{{asset('upload/shelterphoto/'.$photo->photo)}}"
            }
            ],
            "group": "Explore"
            }</script></a></div>
          @endforeach
          </div>
          <div class="slider-arrow-left w-slider-arrow-left"></div>
          <div class="slider-arrow-left slider-arrow-right w-slider-arrow-right"></div>
          <div class="slide-nav w-slider-nav w-round"></div>
        </div>
        @endisset
      </div>
      </section>      
    @endif
@endisset


<style type="text/css">
  .card-aling-image img{
    width: 100%;
  }
  .slide-image img{
    width: 100%;
  }
</style>

@isset($peopleAndStory)
    @if ($peopleAndStory->module_status=="Active")
    <section id="stories" class="gray-section">
      <div class="big-container w-clearfix">
        <div class="content-left-align-wrap">
          <h5 class="dark-gray">{{$peopleAndStory->section_sub_title}}</h5>
          <h3>{{$peopleAndStory->section_title}}</h3>
          <p class="dark-gray">{{$peopleAndStory->section_description}}</p>
        </div>
        @isset($peopleFeedback)
        <div class="cards-wrap">
          @foreach ($peopleFeedback as $feedback)
          <div data-w-id="c6886962-0b6a-6b8a-c475-f1a913574cad" style="opacity:0" class="card-holder">
            <div class="card-aling-image"><img src="{{asset('upload/peoplefeedback/'.$feedback->photo)}}" srcset="{{asset('upload/peoplefeedback/'.$feedback->photo)}} 500w, {{asset('upload/peoplefeedback/'.$feedback->photo)}} 800w, {{asset('upload/peoplefeedback/'.$feedback->photo)}} 1080w" sizes="(max-width: 479px) 100vw, (max-width: 767px) 420.0000305175781px, (max-width: 991px) 55vw, 27vw" alt="" class="card-holder-image"></div>
            <div class="card-contents">
              <h4>&quot; {{$feedback->feedback}} &quot;</h4>
              <p class="small-paragraph">{{$feedback->feedback_author}}</p>
            </div>
          </div>
          @endforeach
        </div>
        @endisset
      </div>
      </section>
    @endif
@endisset

@isset($roomInfo)
    @if ($roomInfo->module_status=="Active")
    <section id="the-room" class="section">
      <div class="room-gallery-container">
        <h2 class="content-center-align">{{$roomInfo->section_title}}</h2>
        @if (!empty($roomInfo->section_sub_title))
          <h5 class="dark-gray">{{$roomInfo->section_sub_title}}</h5>
        @endif
        
        @isset($roomDetail)
        <div data-delay="8000" data-animation="slide" data-autoplay="1" data-easing="ease-in-out" data-duration="800" data-infinite="1" class="room-gallery-slider w-slider">
          <div class="room-gallery-slider-mask w-slider-mask">
            
            @foreach ($roomDetail as $room)
            <div class="room-gallery-slide w-slide">
              <div class="slide-wrap">
                <div class="slide-image"><img src="{{asset('upload/roomdetail/'.$room->photo)}}" srcset="{{asset('upload/roomdetail/'.$room->photo)}} 500w, {{asset('upload/roomdetail/'.$room->photo)}} 800w, {{asset('upload/roomdetail/'.$room->photo)}} 1080w, {{asset('upload/roomdetail/'.$room->photo)}} 1600w, {{asset('upload/roomdetail/'.$room->photo)}} 2000w, {{asset('upload/roomdetail/'.$room->photo)}} 2600w, {{asset('upload/roomdetail/'.$room->photo)}} 3200w, {{asset('upload/roomdetail/'.$room->photo)}} 3843w" sizes="(max-width: 479px) 78vw, (max-width: 991px) 81vw, 52vw" alt=""></div>
                <div class="slide-base">
                  <div>
                    <h5 class="dark-gray">{{$room->room_sub_title}}</h5>
                    <h3 class="margin-bottom">{{$room->room_title}}</h3>
                    <p class="gray">{{$room->room_detail}}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
          </div>
          <div class="slider-arrow-left w-slider-arrow-left"></div>
          <div class="slider-arrow-left slider-arrow-right w-slider-arrow-right"></div>
          <div class="w-hidden-main w-hidden-medium w-hidden-small w-hidden-tiny w-slider-nav"></div>
        </div>
        @endisset
        


      </div>
      </section>
    @endif
@endisset


<section style="margin-bottom: -6px;" id="map">
    {!!$site->site_map!!}
</section>
@endsection

@section('js')
    <!-- Add fancyBox -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" type="text/css" media="screen" />
<script>

$(document).ready(function(){
  $('.playpause').fancybox({
      caption : function( instance, item ) {
        return '';
      }
    });

    // $('a.playpause').click(function() {
      
    //     $.fancybox.open({toolbar  : false,type: 'iframe', href: $(this).attr('href'), openEffect: 'none', closeEffect: 'none', padding: 0, height: 450, helpers: {media: {}}, afterShow: function() {
    //       this.content.find('video').trigger('play'),
    //       setTimeout(function() {
    //         $('div.fancybox-close').animate({right: -42}, 500, 'easeOutBounce');
    //       }, 300);
    //     }});
    //     return false;
    //   });

    });

      $(document).ready(function(e){
          $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");

          $(".main-book-now-button").click(function(e){
              Swal.showLoading ();
              var arival_date=$("#datetimepicker").val();
              var departure_date=$("#datetimepicker2").val();

              var lg_Adults=$("select[name='lg_Adults']").val();
              var lg_Children=$("select[name='lg_Children']").val();

              if(arival_date.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Select Arrival Date!!!</h5>'
                  });
                  return false;
              }

              if(departure_date.length==0)
              {
                  Swal.fire({
                      icon: 'error',
                      title: '<h3 class="text-danger">Warning</h3>',
                      html: '<h5>Please Select Departure Date!!!</h5>'
                  });
                  return false;
              }

              Swal.showLoading();
              $.ajax({
                  'async': false,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': "{{url('cpe/checking/booking')}}",
                  'data': { 
                      'arrival_date': arival_date, 
                      'departure_date':departure_date, 
                      'adults': lg_Adults, 
                      'children': lg_Children, 
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
                      if(data == 0)
                      {
                          Swal.fire({
                              icon: 'success',
                              title: '<h3 class="text-success">Congratulations</h3>',
                              html: '<h5>Booking available, Please wait redirecting to payment page.</h5>'
                          });

                          setTimeout(() => {
                            window.location.href="{{url('booking')}}/"+arival_date+"/"+departure_date+"/"+lg_Adults+"/"+lg_Children;
                          }, 2000);

                      }
                      else
                      {
                          Swal.fire({
                              icon: 'error',
                              title: '<h3 class="text-danger">Sorry</h3>',
                              html: '<h5>Booking not available on selected date range !!!</h5>'
                          });
                      }
                      
                  }
              });

              e.preventDefault();

              //alert('working');
          });

      });

        
    </script>
@endsection