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

	<!-- Modal -->
	@auth
		<div class="modal fade" id="referrals" tabindex="-1" role="dialog" aria-labelledby="referralsLabel"
		     aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="referralsLabel">دعوة صديق</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="text-center">
							<h4>شكرا لدعمك منصة لينكاتي 😻</h4>
							<p>عندما يسجل شخص عن طريقك سوف تحصل على ميزات الحساب المدفعة مجانا لمدة شهر 😎، ما
							   رئيك؟</p>
						</div>

						<div class="form-group">
							<label class="font-weight-600">البريد الإلكتروني</label>
							<input type="email" class="form-control" placeholder="سوف نرسل له دعوة" required>
						</div>
						<div class="form-group">
							<label class="font-weight-600">أو عن طريق الرابط التالي</label>
							<input type="text" dir="ltr" class="form-control" readonly disabled
							       value="{{auth()->user()->referral_link}}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-text text-danger" data-dismiss="modal">اغلاق</button>
						<button type="button" class="btn btn-primary">ادعو صديق</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="upgradeLabel"
		     aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="upgradeLabel">
							الحساب المميز
							<small class="badge badge-danger">قريبا</small>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="card mb-5 mb-lg-0">
							<div class="card-body">
								<h3 class="card-title text-uppercase text-center">الحساب المميز</h3>
								<h6 class="card-price text-muted text-center">$5<span class="period">/شهرياً</span>
								</h6>
							</div>
							<ul class="list-group list-group-flush p-0">
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									عدد غير محدود من الحسابات والمشاريع
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									احصائيات مفصلة عن الحساب والروابط
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									الربط مع Google Analytics
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									امكانية تخصيص نوع الرابط
								</li>
								<li class="list-group-item">
									<i class="fas fa-check"></i>
									<span>
										اماكنية تخصيص مظهر الحساب بشكل كامل، والعديد من القوالب المدفوعة
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endauth
@endsection

