@extends('layouts.auth')
@section('subtitle', __('Login'))
@php($type = 'Sign in')
@section('section-title', __('Login'))
@section('section-subtitle', 'أهلاً بعودتك!')
@section('form')
	<form method="POST" action="{{ route('login') }}" class="mt-4">
		@csrf

		@component('components.form-group', ['type' => 'email', 'name' => 'email'])
			@slot('label', __('E-Mail Address'))
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

		@component('components.form-group', ['type' => 'checkbox', 'name' => 'remember'])
			@slot('label', __('Remember Me'))
		@endcomponent

		<div class="text-center">
			<button type="submit" class="btn btn-secondary w-100">
				{{ __('Login') }}
			</button>

			<small class="mt-3 d-block">
				@if(Route::has('password.request'))
					<a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				@endif
			</small>
		</div>
	</form>
@endsection
