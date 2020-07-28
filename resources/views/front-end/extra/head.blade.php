<meta charset="utf-8">
<title>{{$site->site_name}} - {{$site->site_title}}</title>
<meta content="{{$site->site_description}}" name="description">
<meta content="{{$site->site_title}}" property="og:title">
<meta content="{{$site->site_description}}" property="og:description">
<meta content="{{asset('upload/sitesetting/'.$site->site_logo)}}" property="og:image">
<meta content="{{$site->site_title}}" property="twitter:title">
<meta content="{{$site->site_description}}" property="twitter:description">
<meta content="{{asset('upload/sitesetting/'.$site->site_logo)}}" property="twitter:image">
<meta property="og:type" content="website">
<meta content="summary_large_image" name="twitter:card">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="Neutrix.Systems" name="generator">
<link href="{{asset('site/css/normalize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('site/css/main.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('site/css/mainormalize.css')}}" rel="stylesheet" type="text/css">

<script src="{{asset('site/js/webfont.js')}}" type="text/javascript"></script>
<script type="text/javascript">WebFont.load({  google: {    families: ["IBM Plex Sans:300,regular,500,700"]  }});</script>
<!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<link href="{{asset('site/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon">
<link href="{{asset('site/images/webclip.png')}}" rel="apple-touch-icon">
<script src="{{asset('site/js/jquery.min.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
	.top-buffer {
		margin-top: 50px;
	}
	.bottom-buffer {
		margin-bottom: 50px;
	}
</style>
	