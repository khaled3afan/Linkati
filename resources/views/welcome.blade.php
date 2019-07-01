@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4 offset-md-2">
				<h2>{{ __('Are You...') }}</h2>

				<!-- List group -->
				<nav class="nav nav-pills nav-fill p-0" id="myList" role="tablist">
					<a class="nav-item nav-link active" data-toggle="list" href="#tab1" role="tab">
						{{ __('Too Many Links?') }}
					</a>
					<a class="nav-item nav-link" data-toggle="list" href="#tab2" role="tab">
						{{ __('Famous?') }}
					</a>
					<a class="nav-item nav-link" data-toggle="list" href="#tab3" role="tab">
						{{ __('Designer Or Creator?') }}
					</a>
				</nav>

				<!-- Tab panes -->
				<div class="tab-content lead mt-4">
					<div class="tab-pane active" id="tab1" role="tabpanel">
						سناب شات، توتير انستجرام؟ انشئ حسابك في لينكاتي واحصل على رابط واحد يحتوي على جميع روابطك
						الاخرى.
					</div>
					<div class="tab-pane" id="tab2" role="tabpanel">
						انغامي، سبوتيفاي، ايتونز ويوتيوب وفر لمعجبيك المكان الانسب لهم للاستمتاع بابداعك 😎
					</div>
					<div class="tab-pane" id="tab3" role="tabpanel">
						هل منتجاتك تتوفر للبيع في اكثر من مكان؟ يمكنك الان نشر رابط واحد ودع عميلك يختار المكان المناسب
						له للشراء!
					</div>
				</div>
			</div>

			<div class="col-md-5">
				<h1 class="font-weight-bold">{{ __('Now, you just need one link!') }}</h1>
				<p class="lead">
					هون الامر على متابعيك باستخدامك خدمة لينكاتي، واجمع كل روابطك في مكان واحد.
				</p>
				<form method="POST" action="{{ route('register') }}" class="card mt-4">
					@csrf
					<div class="card-header text-center">
						<h4>{{ __('Create your account for free.') }}</h4>
						<a href="#" class="btn btn-primary mt-2">
							<i class="fab fa-instagram"></i>
							{{__('Sign up with Instagram')}}
						</a>
					</div>

					<div class="card-body">
						<div class="form-group">
							<input id="name" type="text" placeholder="{{ __('Name') }}"
							       class="form-control @error('name') is-invalid @enderror" name="name"
							       value="{{ old('name') }}" required autocomplete="name">

							@error('name')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
							       class="form-control @error('email') is-invalid @enderror" name="email"
							       value="{{ old('email') }}" required autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<input id="password" type="password" placeholder="{{ __('Password') }}"
							       class="form-control @error('password') is-invalid @enderror" name="password"
							       required autocomplete="new-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<div class="input-group mb-2" dir="ltr">
								<div class="input-group-prepend">
									<div class="input-group-text">linkati.me/</div>
								</div>
								<input id="username" type="text" placeholder="{{ __('@username') }}"
								       class="form-control @error('username') is-invalid @enderror" name="username"
								       value="{{ old('username') }}" required autocomplete="name">
							</div>

							@error('username')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>
					</div>

					<div class="card-footer text-center">
						<button type="submit" class="btn btn-primary">
							{{ __('Register') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
