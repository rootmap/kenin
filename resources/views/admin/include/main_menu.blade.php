<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
      <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}"
           alt="Admin Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Kenin Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="{{url('crud')}}" class="nav-link {{ Request::path() == 'crud' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>CRUD</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('bookingrequest/create','bookingrequest','bookingconfiguration'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('bookingrequest/create','bookingrequest','bookingconfiguration'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Booking
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('bookingconfiguration')}}" class="nav-link {{ Request::path() == 'bookingconfiguration' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Configuration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingrequest/create')}}" class="nav-link {{ Request::path() == 'bookingrequest/create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Booking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingrequest')}}" class="nav-link {{ Request::path() == 'bookingrequest' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('payment/log')}}" class="nav-link {{ Request::path() == 'payment/log' ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>Payment log</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('slider')}}" class="nav-link {{ Request::path() == 'slider' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Slider</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('dreamcontent')}}" class="nav-link {{ Request::path() == 'dreamcontent' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dream Content</p>
            </a>
          </li>
          
          
          
          
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('exploreshelterinfo','shelterphoto'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('exploreshelterinfo','shelterphoto'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Explore The Shelter
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('exploreshelterinfo')}}" class="nav-link {{ Request::path() == 'exploreshelterinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Explore Shelter Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('shelterphoto')}}" class="nav-link {{ Request::path() == 'shelterphoto' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shelter Photos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ in_array(Request::path(),array('peopleandstory','peoplefeedback'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('peopleandstory','peoplefeedback'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                People & Stories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('peopleandstory')}}" class="nav-link {{ Request::path() == 'peopleandstory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>People & Stories Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('peoplefeedback')}}" class="nav-link {{ Request::path() == 'peoplefeedback' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>People Feedback</p>
                </a>
              </li>
            </ul>
          </li>
          


          <li class="nav-item has-treeview {{ in_array(Request::path(),array('roominfo','roomdetail','room'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('roominfo','roomdetail','room'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Room Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('roominfo')}}" class="nav-link {{ Request::path() == 'roominfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Room Section Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('roomdetail')}}" class="nav-link {{ Request::path() == 'roomdetail' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Room Details</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{url('room')}}" class="nav-link {{ Request::path() == 'room' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Room Details</p>
                </a>
              </li> --}}
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url('rentalservice')}}" class="nav-link {{ Request::path() == 'rentalservice' ? 'active' : '' }}">
              <i class="nav-icon fas fa-phone-square-alt"></i>
              <p>Rental Service</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('sitesetting','fottermenu','topmenu','fotterpagecontent','cardpointestoresetting'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('sitesetting','fottermenu','topmenu','fotterpagecontent','cardpointestoresetting'))?'active':'' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sitesetting')}}" class="nav-link {{ Request::path() == 'sitesetting' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('cardpointestoresetting')}}" class="nav-link {{ Request::path() == 'cardpointestoresetting' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cardpointe Store Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('topmenu')}}" class="nav-link {{ Request::path() == 'topmenu' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Menu</p>
                </a>
              </li>
              
  
              <li class="nav-item">
                <a href="{{url('fottermenu')}}" class="nav-link {{ Request::path() == 'fottermenu' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fotter Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('fotterpagecontent')}}" class="nav-link {{ Request::path() == 'fotterpagecontent' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fotter Page Content</p>
                </a>
              </li>
              
              
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    {{-- ============================================ --}}
    <div class="side-bar-bottom">
        <ul class="list-unstyled">
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Edit Profile"><a
              href="#"><i class="fas fa-cog"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Change Password"><a
              href="#"><i class="fas fa-key"></i></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Lockscreen"><a
              href="#"><i class="fas fa-unlock"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Logout">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
          </li>
        </ul>
      </div><!-- End side-bar-bottom -->
  </aside>

  <style type="text/css">
    .side-bar-bottom {
      width: 100%;
      height: 35px;
      background-color: #343a40;
      position: -webkit-sticky;
      position: sticky;
      bottom: 0px;
      margin-top: 93%;
      color: #cccccc;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      border-top: 2px solid #444a50;
      padding-top: 25px;
      /*-webkit-box-shadow: 0px 2px 5px 5px black;
      box-shadow: 0px 2px 5px 5px black;*/
  }
  .side-bar-bottom ul li a i{
    color: #fff;
    padding: 10px;
  }
  </style>