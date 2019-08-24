@extends('layouts.app')
@section('subtitle', 'انشاء ملف شخصي')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 col-sm-12">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="profile-preview">
						<create-profile></create-profile>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
