@extends('layouts.auth')
@section('subtitle', __('Reset Password'))
@section('section-title', __('Reset Password'))
@section('section-subtitle', 'سوف تصلك رسالة الى البريد الالكتروني تحمل رابط لتعين كلمة مرور جديدة.')
@section('form')
	<form method="POST" action="{{ route('password.email') }}" class="mt-4">
		@csrf

		@component('components.form-group', ['type' => 'email', 'name' => 'email'])
			@slot('label', __('E-Mail Address'))
			@slot('attributes', [
				'placeholder' => __('E-Mail Address'),
				'autocomplete' => 'email',
				'required'
			])
		@endcomponent

		<div class="text-center">
			<button type="submit" class="btn btn-secondary w-100">
				{{ __('Send Password Reset Link') }}
			</button>

			<small class="mt-3 d-block">
				<a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
					{{ __('Login') }}
				</a>
			</small>
		</div>
	</form>
@endsection
