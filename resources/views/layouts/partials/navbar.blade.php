<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom _shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			<img src="/images/logo.png" width="170px" alt="{{ config('app.name', 'Laravel') }}">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
		        data-target="#navbarSupportedContent"
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