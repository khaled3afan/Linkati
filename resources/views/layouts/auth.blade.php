@extends('layouts.master')
@push('body-class', 'homepage')
@section('body')
	@include('layouts.partials.navbar')

	<section class="pt-4">
		<div class="container">
			<div class="row">
				<div class="auth-form col-md-6 col-sm-12">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<h1 class="text-primary font-weight-600 mb-3">
						@yield('section-title')
					</h1>
					<p class="font-weight-500 lead">
						@yield('section-subtitle')
					</p>

					@if(isset($type))
						<div class="form-group">
							<a href="{{ route('auth.socialite', 'google') }}" class="btn btn-google mt-4 w-100"
							   title="{{__($type.' with Google')}}">
								<i class="mr-2 fab fa-google"></i>
								{{__($type.' with Google')}}
							</a>
							<a href="{{ route('auth.socialite', 'twitter') }}" class="btn btn-twitter mt-4 w-100"
							   title="{{__($type.' with Twitter')}}">
								<i class="mr-2 fab fa-twitter"></i>
								{{__($type.' with Twitter')}}
							</a>
							<a href="{{ route('auth.socialite', 'facebook') }}" class="btn btn-facebook mt-4 w-100"
							   title="{{__($type.' with Facebook')}}">
								<i class="mr-2 fab fa-facebook-f"></i>
								{{__($type.' with Facebook')}}
							</a>
						</div>

						<div class="divider text-center position-relative my-4 font-weight-500">
							<span class="bg-primary text-white d-block">او</span>
						</div>
					@endif

					@yield('form')
				</div>

				<div class="col-12 pb-5"></div>

				<div class="col-md-7 d-none d-md-block d-lg-block">
					<div class="row">
						@include('layouts.partials.footer')
					</div>
				</div>
			</div>
		</div>
	</section>

	<aside class="sidebar col-lg-6 col-md-6 col-sm-12">
		<ul class="list-unstyled pl-0 pl-md-5">
			<li class="media">
				<div class="bg-white rounded mr-3 p-3">
					<img src="/images/icons/robot@2x.png" class="img-fluid" alt="ناشط على السوشال ميديا؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">ناشط على السوشال ميديا؟</h5>
					اجمع روابط حساباتك على السوشال ميديا في مكان واحد! انستقرام؟ تويتر؟ سنابشات؟ اجمع كل شيء في صفحة
					واحدة.
				</div>
			</li>

			<li class="media">
				<div class="bg-white rounded mr-3 p-3">
					<img src="/images/icons/microphone-spotlight@2x.png" class="img-fluid" alt="موسيقيّ؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">موسيقيّ؟</h5>
					سبوتفاي؟ يوتيوب؟ ساوندكلاود؟ اسمح لمعجبيك بالوصول لكافة حساباتك على هذه الخدمات من مكان واحد.
				</div>
			</li>

			<li class="media">
				<div class="bg-white rounded mr-3 p-3">
					<img src="/images/icons/gentleman@2x.png" class="img-fluid" alt="صانع محتوى؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">صانع محتوى؟</h5>
					تعمل مع الكثير من المواقع أو المنصات؟ لا مشكلة! اجمع كافة أعمالك في مكان واحد.
				</div>
			</li>
		</ul>

		<div class="iphone-demo text-center mt-5">
			<img src="/images/iPhoneFull@2x.png" class="img-fluid mx-auto" alt="حسابك في لينكاتي">
		</div>
	</aside>

	<div class="d-block d-md-none d-lg-none">
		@include('layouts.partials.footer')
	</div>
@endsection
