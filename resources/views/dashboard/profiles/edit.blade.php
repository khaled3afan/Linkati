@extends('layouts.app')
@section('subtitle', $profile->name)
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 mb-5">
				<div class="col-lg-5 mx-auto">
					<div class="input-group cursor-pointer"
					     v-clipboard:success="copied"
					     v-clipboard:copy="profile.route">
						<div class="input-group-append" data-toggle="tooltip" data-placement="bottom"
						     title="{{ __('Copy') }}">
							<span class="input-group-text">
								<i class="far fa-copy"></i>
							</span>
						</div>
						<a class="input-group-prepend" data-toggle="tooltip" data-placement="bottom"
						   title="{{ __('Open') }}" :href="profile.route" target="_blank">
							<span class="input-group-text rounded-0 border-left-0">
									<i class="fas fa-external-link-alt"></i>
							</span>
						</a>
						<input type="text" class="form-control" dir="ltr" readonly disabled
						       :value="profile.route">
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-4">
				<div class="card">
					<ul class="list-group list-group-flush p-0">
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link active" data-toggle="pill" href="#profile-preview">
								{{ __('Preview') }}
							</a>
						</li>
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link" data-toggle="pill" href="#profile-edit">
								{{ __('Edit Profile') }}
							</a>
						</li>
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link" data-toggle="pill" href="#profile-links">
								{{ __('My Links') }}
							</a>
						</li>
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link" data-toggle="pill" href="#profile-customize">
								{{ __('Customize') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-7 col-sm-12">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="profile-preview">
						<div class="row">
							<div class="col-lg-8 mx-auto">
								<profile-card></profile-card>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="profile-edit">
						<edit-profile :profile_id="{{ $profile->id }}"></edit-profile>
					</div>
					<div class="tab-pane fade" id="profile-links">
						<edit-links></edit-links>
					</div>
					<div class="tab-pane fade" id="profile-customize">
						<customize-profile></customize-profile>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
