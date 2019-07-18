@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-3 col-md-4">
				<div class="card">
					<ul class="list-group list-group-flush p-0">
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link active" data-toggle="pill" href="#edit-account">
								{{ __('Edit Account') }}
							</a>
						</li>
						<li class="list-group-item py-1 pr-0 font-weight-500">
							<a class="nav-link" data-toggle="pill" href="#change-password">
								{{ __('Change Password') }}
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-md-7 col-sm-12">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="edit-account">
						<edit-account></edit-account>
					</div>
					<div class="tab-pane fade" id="change-password">
						<change-password></change-password>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
