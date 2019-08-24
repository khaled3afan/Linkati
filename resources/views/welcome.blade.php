@extends('layouts.master')
@section('subtitle', 'الآن ما تحتاجه هو رابط واحد فقط! - انشاء رابط مختصر لحسابك في الشبكات الاجتماعية')
@push('body-class', 'homepage')
@section('body')
	@include('layouts.partials.navbar')

	<section class="pt-4">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-sm-12">
					<h1 class="text-primary font-weight-600 mb-3">
						لديك فرصة واحدة لاستخدام الرابط، اجعلها اكثر!
					</h1>
					<p class="font-weight-500 lead">
						هون الامر على متابعيك باستخدامك خدمة لينكاتي، واجمع كل روابطك في مكان واحد.
					</p>

					<div class="form-group">
						<a href="{{ route('auth.social', 'google') }}" class="btn btn-google mt-4 w-100"
						   title="{{__('Sign up with Google')}}">
							<i class="mr-2 fab fa-google"></i>
							{{__('Sign up with Google')}}
						</a>
						<a href="{{ route('auth.social', 'twitter') }}" class="btn btn-twitter mt-4 w-100"
						   title="{{__('Sign up with Twitter')}}">
							<i class="mr-2 fab fa-twitter"></i>
							{{__('Sign up with Twitter')}}
						</a>
						<a href="{{ route('auth.social', 'facebook') }}" class="btn btn-facebook mt-4 w-100"
						   title="{{__('Sign up with Facebook')}}">
							<i class="mr-2 fab fa-facebook-f"></i>
							{{__('Sign up with Facebook')}}
						</a>
					</div>

					<div class="divider text-center position-relative my-4 font-weight-500">
						<span class="bg-primary text-white d-block">او</span>
					</div>

					<form method="POST" action="{{ route('register') }}" class="mt-4">
						@csrf

						@component('components.form-group', ['type' => 'text', 'name' => 'name'])
							@slot('attributes', [
								'placeholder' => __('Name'),
								'autocomplete' => 'name',
								'required'
							])
						@endcomponent

						@component('components.form-group', ['type' => 'email', 'name' => 'email'])
							@slot('attributes', [
								'placeholder' => __('E-Mail Address'),
								'autocomplete' => 'email',
								'required'
							])
						@endcomponent

						@component('components.form-group', ['type' => 'password', 'name' => 'password'])
							@slot('attributes', [
								'placeholder' => __('Password'),
								'autocomplete' => 'new-password',
								'required'
							])
						@endcomponent

						@component('components.form-group', ['type' => 'text', 'name' => 'username'])
							@slot('inputGroup', '<i dir="ltr" class="text-muted">linkati.me/</i>')
							@slot('attributes', [
								'placeholder' => __('Username'),
								'autocomplete' => 'username',
								'dir' => 'ltr',
								'required',
							])
						@endcomponent

						<div class="text-center">
							<small class="my-4 d-block">
								بضغطك على تسجيل أنت توافق على
								<a href="{{ route('pages.terms') }}"><u>شروط الإستخدام</u></a>
								و
								<a href="{{ route('pages.privacy') }}"><u>سياسة الخصوصية</u></a>.
							</small>

							<button type="submit" class="btn btn-secondary w-100">
								انشئ حسابك الآن
							</button>
						</div>
					</form>
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
					<img src="/images/icons/robot@2x.png" class="img-fluid" alt="صاحب روابط كثيرة؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">صاحب روابط كثيرة؟</h5>
					سناب شات، توتير انستجرام؟ انشئ حسابك في لينكاتي واحصل على رابط واحد يحتوي على جميع روابطك الاخرى.
				</div>
			</li>

			<li class="media">
				<div class="bg-white rounded mr-3 p-3">
					<img src="/images/icons/microphone-spotlight@2x.png" class="img-fluid" alt="مشهور؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">مشهور؟</h5>
					انغامي، سبوتيفاي، ايتونز ويوتيوب وفر لمعجبيك المكان الانسب لهم للاستمتاع بابداعك
				</div>
			</li>

			<li class="media">
				<div class="bg-white rounded mr-3 p-3">
					<img src="/images/icons/gentleman@2x.png" class="img-fluid" alt="مبدع او مصمم؟">
				</div>
				<div class="media-body font-weight-500">
					<h5 class="mt-0 mb-2 text-primary font-weight-600">مبدع او مصمم؟</h5>
					هل منتجاتك تتوفر للبيع في اكثر من مكان؟ يمكنك الان نشر رابط واحد ودع عميلك يختار المكان المناسب له
					للشراء!
				</div>
			</li>
		</ul>

		<div class="iphone-demo text-center mt-5">
			<img src="/images/iPhoneFull@2x.png" class="img-fluid mx-auto _position-absolute" alt="">
		</div>
	</aside>

	<div class="d-block d-md-none d-lg-none">
		@include('layouts.partials.footer')
	</div>
@endsection
