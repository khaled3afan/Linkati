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
	<link href="{{ asset('css/_bootstrap-rtl.css') }}" rel="stylesheet">
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
	<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom _shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="/images/logo.png" width="170px" alt="{{ config('app.name', 'Laravel') }}">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			        aria-controls="navbarSupportedContent" aria-expanded="false"
			        aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				@auth
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
							   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ isset($profile) ? $profile->name: __('Profiles') }}
								<span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								@foreach(auth()->user()->profiles as $profile)
									<a class="dropdown-item" href="{{ route('profiles.show', $profile) }}">
										<img src="{{$profile->avatar_url}}" alt="{{$profile->name}}"
										     class="rounded-circle mr-2" width="25px">
										{{ $profile->name }}
									</a>
								@endforeach
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-success" href="{{ route('profiles.create') }}">
									<span class="border rounded-circle text-center d-inline-block"
									      style="width: 25px;height: 25px">
										<i class="fa fa-plus"></i>
									</span>
									{{ __('New Profile') }}
								</a>
							</div>
						</li>
					</ul>
				@endauth

				<ul class="navbar-nav ml-auto">
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item">
							<a class="nav-link" href="#referrals">
								{{ __('Refer a Friend') }}
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-secondary" href="#upgrade">
								{{ __('Upgrade Now') }}
								<small class="badge badge-danger">قريبا</small>
							</a>
						</li>

						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
							   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<img src="{{auth()->user()->avatar}}" alt="{{auth()->user()->name}}"
								     class="rounded-circle" width="30">
								<span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('users.edit') }}">
									{{ __('My Account') }}
								</a>

								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="{{ route('logout') }}"
								   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>

	<main class="py-4">
		@yield('content')
	</main>

	<footer class="footer py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<nav class="nav">
							<a class="nav-item nav-link" href="#!">عن لينكاتي</a>
							<a class="nav-item nav-link" href="#!">سياسة الخصوصية</a>
							<a class="nav-item nav-link" href="#!">شروط الاستخدام</a>
						</nav>
					</div>

					<p>
						&copy; {{ date('Y') }}
						لينكاتي، بواسطة
						<a href="https://hussam3bd.com" target="_blank">
							<u>حسام عبد</u>
						</a>
					</p>
				</div>
				<div class="col-md-6">
					<div class="row">
						<nav class="nav mr-auto">
							<a href="https://instagr.am/linkatiapp" target="_blank"
							   rel="nofollow noopener noreferrer" title="Twitter" class="nav-link nav-item">
								<i class="fab fa-twitter"></i>
							</a>
							<a href="https://twitter.com/linkatiapp" target="_blank"
							   rel="nofollow noopener noreferrer" title="Instagram" class="nav-link nav-item">
								<i class="fab fa-instagram"></i>
							</a>
							<a href="https://fb.com/linkatiapp" target="_blank" rel="nofollow noopener noreferrer"
							   title="Facebook" class="nav-link nav-item">
								<i class="fab fa-facebook-f"></i>
							</a>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
</body>
</html>
