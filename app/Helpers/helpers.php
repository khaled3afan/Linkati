<?php

namespace App\Helpers;

use Hashids;

class Helper
{
    /**
     *
     */
    public static function referredBy()
    {
        $cookie = \Cookie::get('referral');

        return array_first(Hashids::decode($cookie));
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
}