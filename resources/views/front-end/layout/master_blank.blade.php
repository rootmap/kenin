<?php 
$info=CoreCustomController::siteInfo();
$site=$info['site'];
$menu=$info['top_menu'];
$fotter_menu=$info['fotter_menu'];
?>
<!DOCTYPE html>
<!--  This site was created in Nuetrix.Systems. http://www.neutrix.co  -->
<!--  Last Published: Wed Jul 01 2020 19:48:41 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5efce875ff35ce820d7ff59a" data-wf-site="5efce87596038b5613cd3b66">
<head>
    @include('front-end.extra.head')
    @yield('css')
</head>
<body>
    <main id="Main" class="header-section utility-pages">
        @include('front-end.extra.navbar')
        @yield('slider')
    </main>
    @yield('content')
    @include('front-end.extra.fotter')  
    @include('front-end.extra.fotter-script')  
    @yield('js')
</body>
</html>