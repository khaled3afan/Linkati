@extends('layouts.master')
@section('subtitle', $profile->name)
@section('description', $profile->bio)
@section('og-image', $profile->avatar_url)
@push('body-class', "theme--{$profile->theme->key}")
@push('head')
	<style>
		html,
		body {
			height: 100%;
			width: 100%;
		}

		.crisp-client {
			display: none;
		}
	</style>
@endpush

@section('body')
	<section class="d-flex align-items-start align-items-md-center justify-content-center mh-100vh">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-6 col-sm-12">

					<div class="card text-center pt-4 pb-2 border-0 bg-transparent">
						<img src="{{$profile->avatar_url}}" alt="{{$profile->name}}"
						     class="rounded-circle mx-auto" width="90px" height="90px">

						<div class="card-body">
							<h1 class="h4 card-title font-weight-600 mb-2">{{ $profile->name }}</h1>
							<small class="text-muted d-block" dir="ltr">{{ '@'.$profile->username }}</small>

							@if($profile->location)
								<p class="card-text mb-1 font-weight-600">
									<span class="d-block mb-2">
										<i class="fas fa-map-marker-alt"></i>
										{{ $profile->location }}
									</span>
								</p>
							@endif

							<p class="card-text mb-0 {{ empty($profile->bio) ? 'd-none' : '' }}">{{ $profile->bio }}</p>
						</div>

						<ul class="nav flex-column p-0">
							@foreach($profile->links as $link)
								<li class="nav-item mb-3">
									<a href="{{$link->external_link}}" title="{{ $link->name }}"
									   class="w-100 btn-lg text-right {{ $profile->theme->settings['button'] }}"
									   rel="nofollow noopener noreferrer">
										<i class="mr-2 {{ $link->icon}}"></i>
										{{ $link->name }}
									</a>
								</li>
							@endforeach
						</ul>
					</div><!-- /.card -->

				</div>
			</div>
		</div>
	</section>

	<footer class="profile-footer text-center">
		<a class="m-auto" href="{{ url('/') }}" title="{{ config('app.name') }}">
			<img src="{{ asset('/images/logo.png') }}" alt="{{ config('app.name') }}" width="150px">
		</a>
	</footer>
@endsection