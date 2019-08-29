<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
	@if('route')
		<title>@yield('title', config('app.name')) - @yield('subtitle', @$settings->subtitle)</title>
	@else
		<title>@yield('subtitle', @$settings->subtitle) - @yield('title', config('app.name', 'Laravel'))</title>
	@endif

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description', @$settings->description)">
	<meta name="keywords" content="@yield('keywords', @$settings->keywords)">

	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#082471">
	<meta name="msapplication-TileColor" content="#082471">
	<meta name="theme-color" content="#ffffff">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Scripts -->
	<script src="{{ mix('js/app.js') }}" defer></script>

	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
	<link href="{{ mix('css/_bootstrap-rtl.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">

	<!-- facebook open graph -->
	<meta property="og:type" content="website"/>
	<meta property="og:site_name"
	      content="@yield('title', @$settings->title) - @yield('subtitle', @$settings->subtitle)"/>
	<meta property="og:url" content="{{ request()->url() }}"/>
	<meta property="og:title" content="@yield('title', @$settings->title) - @yield('subtitle', @$settings->subtitle)"/>
	<meta property="og:description" content="@yield('description', @$settings->description)"/>
	<meta property="og:image" content="@yield('og-image', url('/images/go.png'))"/>
	<meta property="og:locale" content="ar_AR"/>
	<!-- end facebook open graph -->

	<!-- Schema MicroData (Google+,Google, Yahoo, Bing,) -->
	<meta itemprop="name" content="@yield('title', @$settings->title) - @yield('subtitle', @$settings->subtitle)"/>
	<meta itemprop="url" content="{{ request()->url() }}"/>
	<meta itemprop="image" content="@yield('og-image', url('/images/go.png'))">
	<meta itemprop="description" content="@yield('description', @$settings->description)"/>
	<!-- End Schema MicroData -->

	<!-- twitter cards -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@linkatiapp">
	<meta name="twitter:creator" content="@linkatiapp">
	<meta name="twitter:title" content="@yield('title', @$settings->title) - @yield('subtitle', @$settings->subtitle)">
	<meta name="twitter:image" content="@yield('og-image', url('/images/go.png'))">
	<meta name="twitter:image:src" content="@yield('og-image', url('/images/go.png'))">
	<meta name="twitter:description" content="@yield('description', @$settings->description)">

	<script type="text/javascript">
        window.Linkati = {!! json_encode([
	        'csrfToken' => csrf_token(),
	        'env' => app()->environment(),
	        'locale' => app()->getLocale(),
	        'domain' => url('/'),
	        'authenticated' => auth()->check(),
	        'auth' => auth()->user(),
        ]) !!};

		@if(isset($profile))
            window.Linkati.profile = {!! $profile !!};

        window.Linkati.themes = {!! \App\Models\Theme::all() !!};
		@endif
	</script>

	<!-- Google Tag Manager -->
	<script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T9PQLFL');
	</script>
	<!-- End Google Tag Manager -->

	@stack('head')
</head>
<body class="@stack('body-class')">
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T9PQLFL" height="0" width="0"
	        style="display:none;visibility:hidden"></iframe>
</noscript>

<div id="app">
	@yield('body')
</div>

@stack('scripts')

@if(session()->has('script'))
	<script type="text/javascript">
        window.onload = function () {
			{!! session('script') !!}
        }
	</script>
@endif
</body>
</html>
