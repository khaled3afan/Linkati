@component('mail::message')
#{{$user->name}}، قام بدعوتك لتجريب منصة لينكاتي!

لينكاتي هي منصة عربية تقدم خدمة إنشاء رابط يحتوي على جميع روابطك المهمة لاستخدامه في وصف حسابك في الشبكات الاجتماعية مثل انستجرام او تويتر.

@component('mail::button', [
	'url' => $user->referral_link ."&utm_source={$user['email']}&utm_medium=Links&utm_campaign=EmailInvitation",
	'color' => 'primary'
])
استكشف لينكاتي الآن
@endcomponent

<small>
	في حال كان هناك أي مشكلة، اقتراح أو ملاحظة يمكنكم التحدث معنا عن طريق المحادثة المباشرة في الموقع أو
   إرسالها مباشرةً عن طريق البريد الإلكتروني التالي: <a href="mailto:hussam@linkati.me">hussam@linkati.me</a>.
</small>

أطيب التحيات، <br> فريق {{ config('app.name') }}
@endcomponent
