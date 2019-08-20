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
}