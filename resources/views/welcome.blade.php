@extends('layouts.auth')
@php($type = 'Sign up')
@section('section-title', 'لديك فرصة لمشاركة رابط واحد؟ ماذا لو استطعت تغيير هذا!')
@section('section-subtitle', 'ساعد متابعيك في الوصول إلى منتجاتك وخدماتك وحساباتك الأخرى باستخدام صفحة بسيطة.')
@section('form')
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
@endsection
