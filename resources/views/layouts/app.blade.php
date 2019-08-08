@extends('layouts.master')

@section('body')

	@include('layouts.partials.navbar')

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

	@include('layouts.partials.footer')

	@auth
		@include('layouts.partials.modals')
	@endauth
@endsection

