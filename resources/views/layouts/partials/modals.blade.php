<div class="modal fade" id="referrals" tabindex="-1" role="dialog" aria-labelledby="referralsLabel"
     aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{ route('referral.invites') }}" method="post" class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="referralsLabel">دعوة صديق</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@csrf

				<div class="text-center">
					<h4 class="mb-4">شكرا لدعمك منصة لينكاتي 😻</h4>
					<p class="d-none">
						عندما يسجل شخص عن طريقك سوف تحصل على ميزات الحساب المدفعة مجانا لمدة شهر 😎، ما
						رئيك؟
					</p>
				</div>

				@component('components.form-group', ['type' => 'email', 'name' => 'email'])
					@slot('label', __('E-Mail Address'))
					@slot('attributes', [
						'required',
						'dir' => 'ltr'
					])

					سوف نرسل له دعوة
				@endcomponent

				<div class="form-group">
					<label class="font-weight-500">أو عن طريق الرابط التالي</label>
					<input type="text" dir="ltr" class="form-control" readonly disabled
					       value="{{auth()->user()->referral_link}}">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-text text-danger" data-dismiss="modal">اغلاق</button>
				<button type="submit" class="btn btn-primary">ادعو صديق</button>
			</div>
		</form>
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

<div class="modal fade" id="projects" tabindex="-1" role="dialog" aria-labelledby="ProjectsLabel"
     aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ProjectsLabel">
					الاعمال
					<small class="badge badge-dark">قريبا</small>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				نعمل حاليا على تطوير خاصية الاعمال التي سوف تتيح لك اضافة مشاريعك واعمالك الفنية الى حسابك الشخصي.
				<strong class="mt-1 d-block">اهم ما يميز خاصية الاعمال:</strong>
				<ul class="mt-2">
					<li>الاعمال مرتبطة بالملف الشخصي، اي يمكن لكل ملف شخصي امتلاك مشاريع خاصة به 😍</li>
					<li>نوع المشروع، يمكنك اضافة عملك الفني سواء كان البوم موسيقي او عمل فني 😎</li>
					<li>الاحصائيات المفصلة للمشروع، عدد الزيارات و عدد النقرات 😉</li>
				</ul>
			</div>
		</div>
	</div>
</div>