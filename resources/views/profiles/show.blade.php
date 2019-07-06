<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">

	<script>
        window.Linkati = {!! json_encode([
	        'csrfToken' => csrf_token(),
	        'env' => app()->environment(),
	        'locale' => app()->getLocale(),
	        'authenticated' => auth()->check(),
	        'domain' => url('/'),
	        'auth' => auth()->user(),
        ]) !!};

		@if(isset($profile))
            window.Linkati.profile = {!! $profile !!};
		@endif
	</script>
</head>
<body class="text-right">
<div id="app">
	<profile-card></profile-card>
</div>
</body>
</html>