@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 mb-5">
				<div class="col-md-5 mx-auto">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="far fa-copy"></i>
							</span>
						</div>
						<input type="text" class="form-control" dir="ltr" readonly
						       value="{{ route('profiles.show', $profile) }}">
					</div>
				</div>
			</div>

			<div class="col-3">
				<nav class="nav flex-column nav-pills" id="v-pills-tab">
					<a class="nav-link active" data-toggle="pill" href="#profile-preview">
						{{ __('Preview') }}
					</a>
					<a class="nav-link" data-toggle="pill" href="#profile-edit">
						{{ __('Edit') }}
					</a>
					<a class="nav-link" data-toggle="pill" href="#profile-customize">
						{{ __('Customize') }}
					</a>
				</nav>
			</div>
			<div class="col-9">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="profile-preview">
						<div class="col-md-5 mx-auto">
							<div class="card text-center">
								<img src="{{ $profile->avatar_url }}" class="card-img-top" alt="{{ $profile->name }}">
								<div class="card-body">
									<h5 class="card-title">{{ $profile->name }}</h5>
									<p class="card-text">Some quick example text to build on the card title and make up
									                     the
									                     bulk of the card's content.</p>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">Cras justo odio</li>
									<li class="list-group-item">Dapibus ac facilisis in</li>
									<li class="list-group-item">Vestibulum at eros</li>
								</ul>
								<div class="card-body">
									<a href="#" class="card-link">Card link</a>
									<a href="#" class="card-link">Another link</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="profile-edit">
						<edit-profile :profile="{{ $profile }}"></edit-profile>
					</div>
					<div class="tab-pane fade" id="profile-customize">
						Edit
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
