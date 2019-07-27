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

	<style>
		html,
		body {
			height: 100%;
			width: 100%;
		}
	</style>
</head>
<body class="text-right">
{{--<div id="app" class="d-flex align-items-start align-items-md-center justify-content-center w-100 h-100 py-5 py-sm-0">--}}
<div id="app" class="py-5">
	<section class="profile-show w-100">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-sm-12">
					<div class="card text-center pt-4">
						<img src="{{$profile->avatar_url}}" alt="{{$profile->name}}"
						     class="rounded-circle mx-auto" width="90px" height="90px">

						<div class="card-body">
							<h4 class="card-title font-weight-600 mb-2">{{ $profile->name }}</h4>
							<small class="text-muted d-block" dir="ltr">{{ '@'.$profile->username }}</small>
							@if($profile->location)
								<span class="d-block mb-2">
									<i class="fas fa-map-marker-alt"></i>
									{{ $profile->location }}
								</span>
							@endif

							<p class="card-text">{{ $profile->bio }}</p>

							<ul class="nav flex-column p-0">
								@foreach($profile->links as $link)
									<li class="nav-item mb-3">
										<a href="{{$link->url}}" class="btn btn-primary w-100 text-right"
										   rel="nofollow noopener noreferrer">
											<i class="ml-2 {{ $link->icon}}"></i>
											{{ $link->name }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="profile-footer text-center">
		<a class="m-auto" href="{{ url('/') }}" title="{{ config('app.name') }}">
			<img src="{{ asset('/images/logo.png') }}" alt="{{ config('app.name') }}" width="150px">
		</a>
	</footer>
</div>
</body>
</html>