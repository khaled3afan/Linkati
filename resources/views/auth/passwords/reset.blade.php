@extends('layouts.auth')
@section('subtitle', __('Reset Password'))
@section('section-title', __('Reset Password'))
@section('section-subtitle', 'تعين كلمة مرور جديدة.')
@section('form')
	<form method="POST" action="{{ route('password.update') }}" class="mt-4">
		@csrf
		<input type="hidden" name="token" value="{{ $token }}">

		@component('components.form-group', ['type' => 'email', 'name' => 'email'])
			@slot('label', __('E-Mail Address'))
			@slot('value', request('email'))
			@slot('attributes', [
				'placeholder' => __('E-Mail Address'),
				'autocomplete' => 'email',
				'required'
			])
		@endcomponent

		@component('components.form-group', ['type' => 'password', 'name' => 'password'])
			@slot('label', __('Password'))
			@slot('attributes', [
				'placeholder' => __('Password'),
				'autocomplete' => 'password',
				'required'
			])
		@endcomponent

		@component('components.form-group', ['type' => 'password', 'name' => 'password_confirmation'])
			@slot('label', __('Confirm Password'))
			@slot('attributes', [
				'placeholder' => __('Confirm Password'),
				'autocomplete' => 'new-password',
				'required'
			])
		@endcomponent

		<div class="text-center">
			<button type="submit" class="btn btn-secondary w-100">
				{{ __('Reset Password') }}
			</button>

			<small class="mt-3 d-block">
				<a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
					{{ __('Login') }}
				</a>
			</small>
		</div>
	</form>
@endsection
