<div data-animation="over-right" class="header w-nav" data-easing2="ease-out" data-easing="ease-in" data-collapse="medium" role="banner" data-no-scroll="1" data-duration="300" id="header">
<a href="{{url('/')}}" aria-current="page" class="logo w-nav-brand w--current" style="width: 158px; top:6px; position: absolute;">
    <img src="{{asset('upload/sitesetting/'.$site->site_logo)}}" alt="{{$site->site_title}}">
</a>
<div class="menu-button w-nav-button">
    <div class="icon-navbar w-icon-nav-menu"></div>
</div>
    <nav role="navigation" class="nav-menu w-nav-menu">
        @isset($menu)
            @foreach ($menu as $nav)
                <a href="{{url('/'.$nav->menu_link)}}" class="nav-link w-nav-link">{{$nav->menu_name}}</a>
            @endforeach
        @endisset
    </nav>
</div>