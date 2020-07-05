<!DOCTYPE html>
<!--  This site was created in Neutrix.co. http://www.neutrix.co  -->
<!--  Last Published: Wed Jul 01 2020 19:48:41 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5efce875ff35ce820d7ff59as" data-wf-site="5efce87596038b5613cd3b663">
<head>
  @include('front-end.extra.head')
</head>
<body>
  <main id="main" class="banner">
    @include('front-end.extra.navbar')
    <div class="banner-content-middle">
      <div class="wrap-banner-content">
        <h1>A chance to go <em>offline</em> and get in touch with nature.</h1>
        <div class="booking-base w-form">
          <form id="wf-form-Booking-Form" name="wf-form-Booking-Form" data-name="Booking Form" class="imputs">
            <div class="imputs-wrap">
              <div class="imput-wrap">
                <label for="Check-in" class="field-label">Arrival Date</label>
                <input type="text" class="imput w-input" maxlength="256" name="Check-in" data-name="Check-in" placeholder="Arrival Date" id="datetimepicker" required="">
                {{-- <input type="text" class="imput w-input" maxlength="256" name="Check-in" id="datetimepicker"/> --}}
              </div>
              <div class="imput-wrap"><label for="Check-out" class="field-label">Departure Date</label><input type="text" class="imput w-input" maxlength="256" name="Check-out" data-name="Check-out" placeholder="Select Arrival Date" id="datetimepicker2" required=""></div>
              <div class="imput-wrap">
                <label for="Guests" class="field-label">Adults</label>
                {{-- <input type="text" class="imput w-input" maxlength="256" name="Guests" data-name="Guests" placeholder="3 Persons" id="guests" required=""> --}}
                <select class="imput w-select w-width100">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
              <div class="imput-wrap">
                <label for="Guests" class="field-label">Children</label>
                {{-- <input type="text" class="imput w-input" maxlength="256" name="Guests" data-name="Guests" placeholder="3 Persons" id="guests" required=""> --}}
                <select class="imput w-select w-width100">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div><input type="submit" value="BOOK NOW" data-wait="One moment please..." class="main-book-now-button w-button"></form>
          <div class="success-message w-form-done">
            <div>Thank you! Your booking details has been received!</div>
          </div>
          <div class="error-message w-form-fail">
            <div>Oops! Something went wrong, please try to be more accurate.</div>
          </div>
        </div>
      </div>
      <a href="#dream" class="scroll-down w-inline-block">
        <div>↓</div>
      </a>
    </div>
  </main>
  <section id="dream" class="dark-section">
    <div class="headline-wrap">
      <h2 class="margin-bottom">The shelter is the outcome of the dream</h2>
      <p class="gray">Triple-mint renovation commodo ligula eget dolor</p>
    </div>
    <div class="benefits">
      <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625cc" style="opacity:0" class="benefits-list">
        <div class="benefits-title">
          <div>Quietness Designed</div>
        </div>
        <div class="benefits-description">
          <p class="gray">Renovation mint quam felis, ultricies nec, pellentesque trendy shops</p>
        </div>
      </div>
      <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625d3" style="opacity:0" class="benefits-list">
        <div class="benefits-title">
          <div>Outdoor Skies</div>
        </div>
        <div class="benefits-description">
          <p class="gray">Cum sociis historic penatibus et magnis dis handyman special montes, nascetur</p>
        </div>
      </div>
      <div data-w-id="24baa3f1-32f9-83c8-2e87-a1cb3b6625da" style="opacity:0" class="benefits-list">
        <div class="benefits-title">
          <div>Nothing More</div>
        </div>
        <div class="benefits-description">
          <p class="gray">Eos an decorative fireplace delicata quo ei luxury discere facilisi</p>
        </div>
      </div>
    </div>
    <div class="big-shelter-image">
      <div class="big-gradient-image"></div>
    </div>
  </section>
  <section id="explore" class="section">
    <div class="small-width-container">
      <div class="explore-the-shelter">
        <h2>Explore The Shelter</h2>
        <div class="shelter-benefits">
          <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c90" style="opacity:0" class="feature">
            <p><span class="text-span-big">1<br>‍</span>Far away from city life</p>
          </div>
          <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c97" style="opacity:0" class="feature">
            <p><span class="text-span-big">2<br>‍</span>Go for a walk in the woods</p>
          </div>
          <div data-w-id="302e00dd-f14b-a98c-0da5-820943142c9e" style="opacity:0" class="feature">
            <p><span class="text-span-big">3<br>‍</span>Add calm to your schedule</p>
          </div>
        </div>
      </div>
      <div data-animation="slide" data-duration="500" data-infinite="1" class="gallery-slider w-slider">
        <div class="gallery-slider-mask w-slider-mask">
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/wooden-house-1795506.jpg" srcset="{{url('site')}}/images/wooden-house-1795506-p-500.jpeg 500w, {{url('site')}}/images/wooden-house-1795506.jpg 750w" sizes="(max-width: 479px) 78vw, (max-width: 767px) 28vw, 29vw" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f7590227d0177981d6e3",
      "fileName": "5efce875ff35ce42717ff5de_wooden-house-1795506.jpg",
      "origFileName": "wooden-house-1795506.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 172622,
      "url": "site/images/wooden-house-1795506.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/person-sitting-on-bed-3182841.jpg" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f7586a42a4e3cd6351de",
      "fileName": "5efce875ff35ce33767ff5db_person-sitting-on-bed-3182841.jpg",
      "origFileName": "person-sitting-on-bed-3182841.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 121080,
      "url": "site/images/person-sitting-on-bed-3182841.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/person-standing-outside-the-house-1876045.jpg" srcset="{{url('site')}}/images/person-standing-outside-the-house-1876045-p-500.jpeg 500w, {{url('site')}}/images/person-standing-outside-the-house-1876045.jpg 750w" sizes="(max-width: 479px) 78vw, (max-width: 767px) 28vw, 29vw" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f7585aa398c8db0a2046",
      "fileName": "5efce875ff35ce19307ff5da_person-standing-outside-the-house-1876045.jpg",
      "origFileName": "person-standing-outside-the-house-1876045.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 95745,
      "url": "site/images/person-standing-outside-the-house-1876045.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/bed-near-glass-window-2881716.jpg" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f7596a42a4cad46351f7",
      "fileName": "5efce875ff35ceb26e7ff5e2_bed-near-glass-window-2881716.jpg",
      "origFileName": "bed-near-glass-window-2881716.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 60266,
      "url": "site/images/bed-near-glass-window-2881716.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/cabin-near-trees-1878810.jpg" srcset="{{url('site')}}/images/cabin-near-trees-1878810-p-500.jpeg 500w, {{url('site')}}/images/cabin-near-trees-1878810.jpg 750w" sizes="(max-width: 479px) 78vw, (max-width: 767px) 28vw, 29vw" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f7586a42a42db96351e1",
      "fileName": "5efce875ff35cea61f7ff5dd_cabin-near-trees-1878810.jpg",
      "origFileName": "cabin-near-trees-1878810.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 155857,
      "url": "site/images/cabin-near-trees-1878810.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
          <div class="gallery-slide-lightbox w-slide"><a href="#" class="lightbox-link w-inline-block w-lightbox"><img src="{{url('site')}}/images/a-retro-telephone-on-the-bedside-table-2843400.jpg" srcset="{{url('site')}}/images/a-retro-telephone-on-the-bedside-table-2843400-p-500.jpeg 500w, {{url('site')}}/images/a-retro-telephone-on-the-bedside-table-2843400.jpg 750w" sizes="(max-width: 479px) 78vw, (max-width: 767px) 28vw, 29vw" alt=""><script type="application/json" class="w-json">{
  "items": [
    {
      "type": "image",
      "_id": "5e12f759946b1254cebef6cd",
      "fileName": "5efce875ff35ce79897ff5e0_a-retro-telephone-on-the-bedside-table-2843400.jpg",
      "origFileName": "a-retro-telephone-on-the-bedside-table-2843400.jpg",
      "width": 750,
      "height": 1000,
      "fileSize": 73389,
      "url": "site/images/a-retro-telephone-on-the-bedside-table-2843400.jpg"
    }
  ],
  "group": "Explore"
}</script></a></div>
        </div>
        <div class="slider-arrow-left w-slider-arrow-left"></div>
        <div class="slider-arrow-left slider-arrow-right w-slider-arrow-right"></div>
        <div class="slide-nav w-slider-nav w-round"></div>
      </div>
    </div>
  </section>
  <section id="stories" class="gray-section">
    <div class="big-container w-clearfix">
      <div class="content-left-align-wrap">
        <h5 class="dark-gray">People and Stories</h5>
        <h3>The choice of shelter</h3>
        <p class="dark-gray">Broker ipsum dolor sit amet, consectetuer luxury elit. Carrara marble commodo ligula eget dolor cum sociis cozy penatibus et magnis</p>
      </div>
      <div class="cards-wrap">
        <div data-w-id="c6886962-0b6a-6b8a-c475-f1a913574cad" style="opacity:0" class="card-holder">
          <div class="card-aling-image"><img src="site/images/backlit-dawn-foggy-friendship-697243.jpg" srcset="site/images/backlit-dawn-foggy-friendship-697243-p-500.jpeg 500w, site/images/backlit-dawn-foggy-friendship-697243-p-800.jpeg 800w, site/images/backlit-dawn-foggy-friendship-697243.jpg 1080w" sizes="(max-width: 479px) 100vw, (max-width: 767px) 420.0000305175781px, (max-width: 991px) 55vw, 27vw" alt="" class="card-holder-image"></div>
          <div class="card-contents">
            <h4>&quot; To get out of the city with all the necessities and nothing more &quot;</h4>
            <p class="small-paragraph">Shelley Whiddon</p>
          </div>
        </div>
        <div data-w-id="c6886962-0b6a-6b8a-c475-f1a913574cb5" style="opacity:0" class="card-holder">
          <div class="card-aling-image"><img src="site/images/woman-spreading-both-her-arms-2529375.jpg" srcset="site/images/woman-spreading-both-her-arms-2529375-p-500.jpeg 500w, site/images/woman-spreading-both-her-arms-2529375-p-800.jpeg 800w, site/images/woman-spreading-both-her-arms-2529375.jpg 1080w" sizes="(max-width: 479px) 100vw, (max-width: 767px) 420.0000305175781px, (max-width: 991px) 55vw, 27vw" alt="" class="card-holder-image"></div>
          <div class="card-contents">
            <h4>&quot; A unique space to unload and recharge even with your childs&quot;</h4>
            <p class="small-paragraph">Margaret Wolfson</p>
          </div>
        </div>
        <div data-w-id="c6886962-0b6a-6b8a-c475-f1a913574cbd" style="opacity:0" class="card-holder">
          <div class="card-aling-image"><img src="site/images/two-person-carrying-black-inflatable-pool-float-on-brown-1020016.jpg" srcset="site/images/two-person-carrying-black-inflatable-pool-float-on-brown-1020016-p-500.jpeg 500w, site/images/two-person-carrying-black-inflatable-pool-float-on-brown-1020016.jpg 1080w" sizes="(max-width: 479px) 100vw, (max-width: 767px) 420.0000305175781px, (max-width: 991px) 55vw, 27vw" alt="" class="card-holder-image"></div>
          <div class="card-contents">
            <h4>&quot; The nature interact as a piece of furniture with such a prominent place &quot;</h4>
            <p class="small-paragraph">Cary Brazeman</p>
          </div>
        </div>
        <div data-w-id="c6886962-0b6a-6b8a-c475-f1a913574cc5" style="opacity:0" class="card-holder">
          <div class="card-aling-image"><img src="site/images/woman-stands-on-mountain-over-field-under-cloudy-sky-at-847483.jpg" srcset="site/images/woman-stands-on-mountain-over-field-under-cloudy-sky-at-847483-p-500.jpeg 500w, site/images/woman-stands-on-mountain-over-field-under-cloudy-sky-at-847483.jpg 1080w" sizes="(max-width: 479px) 100vw, (max-width: 767px) 420.0000305175781px, (max-width: 991px) 55vw, 27vw" alt="" class="card-holder-image"></div>
          <div class="card-contents">
            <h4>&quot; A place with nature omnipresent and the landscape purposely framed &quot;</h4>
            <p class="small-paragraph">Scott Milano</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="the-room" class="section">
    <div class="room-gallery-container">
      <h2 class="content-center-align">The Room</h2>
      <div data-delay="8000" data-animation="slide" data-autoplay="1" data-easing="ease-in-out" data-duration="800" data-infinite="1" class="room-gallery-slider w-slider">
        <div class="room-gallery-slider-mask w-slider-mask">
          <div class="room-gallery-slide w-slide">
            <div class="slide-wrap">
              <div class="slide-image"><img src="{{url('site')}}/images/flat-screen-tv-2659629.jpg" srcset="{{url('site')}}/images/flat-screen-tv-2659629-p-500.jpeg 500w, {{url('site')}}/images/flat-screen-tv-2659629-p-800.jpeg 800w, {{url('site')}}/images/flat-screen-tv-2659629-p-1080.jpeg 1080w, {{url('site')}}/images/flat-screen-tv-2659629-p-1600.jpeg 1600w, {{url('site')}}/images/flat-screen-tv-2659629-p-2000.jpeg 2000w, {{url('site')}}/images/flat-screen-tv-2659629-p-2600.jpeg 2600w, {{url('site')}}/images/flat-screen-tv-2659629-p-3200.jpeg 3200w, {{url('site')}}/images/flat-screen-tv-2659629.jpg 3843w" sizes="(max-width: 479px) 78vw, (max-width: 991px) 81vw, 52vw" alt=""></div>
              <div class="slide-base">
                <div>
                  <h5 class="dark-gray">THE ROOM</h5>
                  <h3 class="margin-bottom">Nature in front of you</h3>
                  <p class="gray">Broker ipsum dolor sit amet, consectetuer Sub-Zero and Wolff elit vibrant</p>
                </div>
              </div>
            </div>
          </div>
          <div class="room-gallery-slide w-slide">
            <div class="slide-wrap">
              <div class="slide-image"><img src="{{url('site')}}/images/brown-padded-chair-2495555.jpg" srcset="{{url('site')}}/images/brown-padded-chair-2495555-p-500.jpeg 500w, {{url('site')}}/images/brown-padded-chair-2495555-p-800.jpeg 800w, {{url('site')}}/images/brown-padded-chair-2495555-p-1080.jpeg 1080w, {{url('site')}}/images/brown-padded-chair-2495555-p-1600.jpeg 1600w, {{url('site')}}/images/brown-padded-chair-2495555-p-2000.jpeg 2000w, {{url('site')}}/images/brown-padded-chair-2495555-p-2600.jpeg 2600w, {{url('site')}}/images/brown-padded-chair-2495555-p-3200.jpeg 3200w, {{url('site')}}/images/brown-padded-chair-2495555.jpg 3843w" sizes="(max-width: 479px) 78vw, (max-width: 991px) 81vw, 52vw" alt=""></div>
              <div class="slide-base">
                <div>
                  <h5 class="dark-gray">THE ROOM</h5>
                  <h3 class="margin-bottom">Pampering included</h3>
                  <p class="gray">Broker ipsum dolor sit amet, consectetuer Sub-Zero and Wolff elit vibrant</p>
                </div>
              </div>
            </div>
          </div>
          <div class="room-gallery-slide w-slide">
            <div class="slide-wrap">
              <div class="slide-image"><img src="{{url('site')}}/images/brown-wooden-house-near-tree-2829034.jpg" srcset="{{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-500.jpeg 500w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-800.jpeg 800w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-1080.jpeg 1080w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-1600.jpeg 1600w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-2000.jpeg 2000w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-2600.jpeg 2600w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034-p-3200.jpeg 3200w, {{url('site')}}/images/brown-wooden-house-near-tree-2829034.jpg 3843w" sizes="(max-width: 479px) 78vw, (max-width: 991px) 81vw, 52vw" alt=""></div>
              <div class="slide-base">
                <div>
                  <h5 class="dark-gray">THE ROOM</h5>
                  <h3 class="margin-bottom">Lunch by the fire<br></h3>
                  <p class="gray">Broker ipsum dolor sit amet, consectetuer Sub-Zero and Wolff elit vibrant</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-arrow-left w-slider-arrow-left"></div>
        <div class="slider-arrow-left slider-arrow-right w-slider-arrow-right"></div>
        <div class="w-hidden-main w-hidden-medium w-hidden-small w-hidden-tiny w-slider-nav"></div>
      </div>
    </div>
  </section>
  <section id="video" class="video-section">
    <div class="video-content">
      <h5 class="gray">A pod of peace designed as a large-scale</h5>
      <h3>We offer unique shelter at various destinations</h3><a href="#header" class="book-now-button w-button">book Now</a></div>
    <div data-poster-url="https://uploads-ssl.webflow.com/5cf75ea2b2092262c7db01fa/5e12f2ae6a42a4ea27633054_Pexels Videos 1970045-poster-00001.jpg" data-video-urls="https://uploads-ssl.webflow.com/5efce87596038b5613cd3b66/5efce875ff35ce4f9f7ff5cf_Pexels%20Videos%201970045-transcode.mp4,https://uploads-ssl.webflow.com/5efce87596038b5613cd3b66/5efce875ff35ce4f9f7ff5cf_Pexels%20Videos%201970045-transcode.webm" data-autoplay="true" data-loop="true" data-wf-ignore="true" class="background-video w-background-video w-background-video-atom"><video autoplay="" loop="" style="background-image:url(&quot;https://uploads-ssl.webflow.com/5cf75ea2b2092262c7db01fa/5e12f2ae6a42a4ea27633054_Pexels Videos 1970045-poster-00001.jpg&quot;)" muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover"><source src="https://uploads-ssl.webflow.com/5efce87596038b5613cd3b66/5efce875ff35ce4f9f7ff5cf_Pexels%20Videos%201970045-transcode.mp4" data-wf-ignore="true"><source src="https://uploads-ssl.webflow.com/5efce87596038b5613cd3b66/5efce875ff35ce4f9f7ff5cf_Pexels%20Videos%201970045-transcode.webm" data-wf-ignore="true"></video></div>
  </section>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-links-wrap"><a href="{{url('/')}}" aria-current="page" class="footer-logo w-inline-block w--current"><img src="{{url('site')}}/images/Sherler-Booking-Logo.svg" alt=""></a>
        <div class="footer-link"><a href="style-guide.html" class="footer-link">Style Guide</a><a href="licensing.html" class="footer-link">Licensing</a><a href="changelog.html" class="footer-link">Changelog</a></div>
        <div id="w-node-a6625981f07a-5981f070" class="footer-text">Theme by <a href="http://dotsnbits.com/" target="_blank" class="footer-link">DOTS N’ BITS</a> Powered by <a href="https://webflow.com/" target="_blank" class="footer-link">Webflow</a></div>
      </div>
    </div>
  </footer>
  @include('front-end.extra.fotter-script')   
</body>
</html>