<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom py-3">
	<div class="container">
		<a class="navbar-brand mr-0" href="{{ url('/') }}" title="{{ config('app.name') }}">
			<img src="/images/logo.png" width="170px" alt="{{ config('app.name') }}">
		</a>

		@auth
			<button class="navbar-toggler border-0" type="button" data-toggle="collapse"
			        data-target="#navbarSupportedContent"
			        aria-controls="navbarSupportedContent" aria-expanded="false"
			        aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
						   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<i class="far fa-address-card mr-2"></i>
							{{ isset($profile) ? Str::limit($profile->name, 15) : __('Profiles') }}
							<span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							@foreach(auth()->user()->profiles as $profile)
								<a class="dropdown-item" href="{{ route('dashboard.profiles.show', $profile) }}">
									<img src="{{$profile->avatar_url}}" alt="{{$profile->name}}"
									     class="rounded-circle mr-2" width="25px" height="25px">
									{{ $profile->name }}
								</a>
							@endforeach
							<div class="dropdown-divider"></div>
							<a class="dropdown-item text-success" href="{{ route('dashboard.profiles.create') }}">
									<span class="border rounded-circle text-center d-inline-block"
									      style="width: 25px;height: 25px">
										<i class="fa fa-plus"></i>
									</span>
								{{ __('New Profile') }}
							</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#projects" data-toggle="modal" data-target="#projects">
							<i class="far fa-folder-open"></i>
							{{ __('My Works') }}
							<small class="badge badge-dark">قريبا</small>
						</a>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto">
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
				</ul>
			</div>
		@else
			<ul class="navbar-nav mr-0 pr-0">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}" title="{{ __('Login') }}">
						<button class="btn btn-login">{{ __('Login') }}</button>
					</a>
				</li>
				@if (Route::has('register'))
					<li class="nav-item d-none">
						<a class="nav-link" href="{{ route('register') }}" title="{{ __('Register') }}">
							<button class="btn btn-link">{{ __('Register') }}</button>
						</a>
					</li>
				@endif
			</ul>
		@endauth
	</div>
</nav>