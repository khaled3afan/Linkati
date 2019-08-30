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

	@if(session()->has('status'))
		<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
			{!! session('status') !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if(session()->has('error'))
		<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
			{!! session('error') !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
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

