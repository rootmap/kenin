<footer class="footer">
    <div class="footer-container">
        <div class="footer-links-wrap">
        <a href="index.html" aria-current="page" class="footer-logo w-inline-block w--current">
            <img src="{{asset('upload/sitesetting/'.$site->site_logo)}}" alt="{{$site->site_title}}">
        </a>
        <div class="footer-link">
            @isset($fotter_menu)
                @foreach ($fotter_menu as $nav)
                    <a href="{{url('/pages/'.$nav->menu_link)}}" class="footer-link">{{$nav->menu_name}}</a>
                @endforeach
            @endisset
        </div>
        <div id="w-node-a6625981f07a-5981f070" class="footer-text">Design & Developed by 
            <a href="https://neutrix.co/" target="_blank" class="footer-link">Neutrix.co</a> Powered by 
            <a href="https://neutrix.co/" target="_blank" class="footer-link">Neutrix</a>
        </div>
        </div>
    </div>
</footer>