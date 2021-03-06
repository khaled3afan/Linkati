<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class Helper
{
    /**
     *
     */
    public static function referredBy()
    {
        $cookie = \Cookie::get('referral');

        return Arr::first(Hashids::decode($cookie));
    }

    /**
     * @param        $url
     * @param string $scheme
     *
     * @return string
     */
    public static function addScheme($url, $scheme = 'http://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
    }

    /**
     * @return bool
     */
    public static function isHome()
    {
        return self::routeName() == 'home';
    }

    /**
     * @return mixed
     */
    public static function routeName()
    {
//        return str_replace('.', '-', Route::currentRouteName());
        return Route::currentRouteName();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function settings()
    {
        # cache()->forget('settings');

        return cache()->rememberForever('settings', function () {
            $path = resource_path('seeders/settings.json');

            return (object)json_decode(file_get_contents($path), true);
        });
    }

    /**
     * [percent description]
     *
     * @param $total
     * @param $amount
     *
     * @return string [type]         [description]
     */
    public static function percent($total, $amount)
    {
        $count = $total != 0 ? ($amount / $total) * 100 : $total;

        return number_format($count, 0);
    }
}
