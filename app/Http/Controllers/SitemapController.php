<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Profile;
use Laravelium\Sitemap\Sitemap;

class SitemapController extends Controller
{
    private $settings;

    protected $title, $description, $logo, $lang;

    /**
     * Set some global Values between all methods
     * @throws \Exception
     */
    public function __construct()
    {
        $this->settings = Helper::settings();
        $this->title = $this->settings->title . '-' . $this->settings->subtitle;
        $this->description = preg_replace('/\s\s+/', ' ', $this->settings->description);
        $this->logo = asset('/images/logo.png');
        $this->lang = 'ar';
    }

    /**
     * Generate Sitemap for diaries and pages.
     *
     * @return XML an XML File which have both diaries & pages links.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function sitemap()
    {
        /** @var Sitemap $sitemap */
        $sitemap = app()->make('sitemap');

        // cache the sitemap for one hour
        $sitemap->setCache('linkati.sitemap', 60);

        if ( ! $sitemap->isCached()) {
            $sitemap->add(url('/'), '', '1.0', 'daily');
//            $sitemap->add(route('blog.index'), '', '1.0', 'daily');

            # Pages
            $sitemap->add(route('login'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'تسجيل الدخول');
            $sitemap->add(route('register'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'حساب جديد');
            $sitemap->add(route('pages.about'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'عن لينكاتي');
            $sitemap->add(route('pages.press'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'البيان الصحفي');
            $sitemap->add(route('pages.privacy'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'سياسة الخصوصية');
            $sitemap->add(route('pages.terms'), '2019-08-30 12:00:00', '0.80', 'monthly', [], 'شروط الاستخدام');
            $sitemap->add(
                route('password.request'),
                '2019-08-30 12:00:00',
                '0.80',
                'monthly',
                [],
                'إستعادة كلمة المرور'
            );

            $profiles = Profile::latest()->get();
            /** @var Profile $profile */
            foreach ($profiles as $profile) {
                $sitemap->add(
                    $profile->route,
                    $profile->updated_at,
                    '0.50',
                    'daily',
                    [],
                    $profile->name
                );
            }
        }

        return $sitemap->render('xml');
    }
}
