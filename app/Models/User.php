<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'providers',
        'settings',
        'referred_by',
        'role',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'json',
        'providers' => 'json',
    ];

    /**
     * @return string
     */
    public function getReferralLinkAttribute()
    {
        return url('/') . '?ref=' . \Hashids::encode($this->id);
    }

    /**
     * @return String
     */
    public function getAvatarAttribute()
    {
        return $this->getGravatar(100);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param int    $size
     * @param string $default
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($size = 90, $default = 'mm', $r = 'g')
    {
        $default = urlencode(asset('/images/avatar.png'));

        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($this->email)));
        $url .= "?s=$size&d=$default&r=$r";

        return $url;
    }

    /**
     * Get the profiles for the user.
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function referrer()
    {
        return $this->hasOne(User::class, 'id', 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by', 'id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); // my notification
    }
}
