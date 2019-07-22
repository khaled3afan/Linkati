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

	<script type="text/javascript">
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

	<script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "533293d7-6508-45dc-826a-8960b3d6df02";
        (function () {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();

		@auth
        $crisp.push(["set", "user:email", "{{ auth()->user()->email }}"]);
        $crisp.push(["set", "user:nickname", "{{ auth()->user()->name }}"]);
		@endauth
	</script>
</head>
<body>
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
								<i class="far fa-address-card mr-2"></i>
								{{ isset($profile) ? $profile->name : __('Profiles') }}
								<span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								@foreach(auth()->user()->profiles as $profile)
									<a class="dropdown-item" href="{{ route('profiles.show', $profile) }}">
										<img src="{{$profile->avatar_url}}" alt="{{$profile->name}}"
										     class="rounded-circle mr-2" width="25px" height="25px">
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
							<a class="nav-link" href="#referrals" data-toggle="modal" data-target="#referrals">
								{{ __('Refer a Friend') }}
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-secondary" href="#upgrade" data-toggle="modal"
							   data-target="#upgrade">
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

	@if (session('verified'))
		<div class="text-center">
			<div class="alert alert-success" role="alert">
				{{ __('Your account has been activated successfully!') }}
			</div>
		</div>
	@endif

	<main class="py-4">
		@yield('content')
	</main>

	<footer class="footer py-5">
		<div class="container">
			<div class="row align-items-center">
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
						<a href="https://hussam3bd.com" target="_blank"
						   title="حسام عبد - عن تصميم تجربة المستخدم وتطوير والويب">
							<u>حسام عبد</u>
						</a>
					</p>
				</div>
				<div class="col-md-6">
					<nav class="nav ml-auto float-left">
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
	</footer>


	<!-- Modal -->
	@auth
		<div class="modal fade" id="referrals" tabindex="-1" role="dialog" aria-labelledby="referralsLabel"
		     aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="referralsLabel">دعوة صديق</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="text-center">
							<h4>شكرا لدعمك منصة لينكاتي 😻</h4>
							<p>عندما يسجل شخص عن طريقك سوف تحصل على ميزات الحساب المدفعة مجانا لمدة شهر 😎، ما رئيك؟</p>
						</div>

						<div class="form-group">
							<label class="font-weight-600">البريد الإلكتروني</label>
							<input type="email" class="form-control" placeholder="سوف نرسل له دعوة" required>
						</div>
						<div class="form-group">
							<label class="font-weight-600">أو عن طريق الرابط التالي</label>
							<input type="text" dir="ltr" class="form-control" readonly disabled
							       value="{{auth()->user()->referral_link}}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-text text-danger" data-dismiss="modal">اغلاق</button>
						<button type="button" class="btn btn-primary">ادعو صديق</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="upgradeLabel"
		     aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="upgradeLabel">
							الحساب المميز
							<small class="badge badge-danger">قريبا</small>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="card mb-5 mb-lg-0">
							<div class="card-body">
								<h3 class="card-title text-uppercase text-center">الحساب المميز</h3>
								<h6 class="card-price text-muted text-center">$5<span class="period">/شهرياً</span></h6>
							</div>
							<ul class="list-group list-group-flush p-0">
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									عدد غير محدود من الحسابات والمشاريع
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									احصائيات مفصلة عن الحساب والروابط
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									الربط مع Google Analytics
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									امكانية تخصيص نوع الرابط
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									<span>
										اماكنية تخصيص مظهر الحساب بشكل كامل، والعديد من القوالب المدفوعة
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endauth
</div>
</body>
</html>
