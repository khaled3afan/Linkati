<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use softDeletes;

    const TYPE_NORMAL = 0;

    protected $icons = [
        'default' => 'fas fa-link',

        'facebook' => 'fab fa-facebook-f',
        'fb' => 'fab fa-facebook-f',
        'instagram' => 'fab fa-instagram',
        'twitter' => 'fab fa-twitter',
        'podcast' => 'fas fa-podcast',
        'soundcloud' => 'fab fa-soundcloud',
        'itunes' => 'fab fa-itunes',
        'spotify' => 'fab fa-spotify',
        'youtube' => 'fab fa-youtube',
        'linkedin' => 'fab fa-linkedin-in',
        'github' => 'fab fa-github',
        'pinterest' => 'fab fa-pinterest-p',
        'gitlab' => 'fab fa-gitlab',
        'bitbucket' => 'fab fa-bitbucket',
        'medium' => 'fab fa-medium-m',
        '500px' => 'fab fa-500px',
        'behance' => 'fab fa-behance',
        'be' => 'fab fa-behance',
        'goodreads' => 'fab fa-goodreads-g',
        'dribbble' => 'fab fa-dribbble',
        'paypal' => 'fab fa-paypal',
        'maps' => 'fas fa-map-marker-alt',
        'play' => 'fab fa-google-play',
        'apps' => 'fab fa-app-store',
        'apple' => 'fab fa-apple',
        'blogger' => 'fab fa-blogger-b',
        'snapchat' => 'fab fa-snapchat-ghost',
        'whatsapp' => 'fab fa-whatsapp',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'type',
        'order',
        'clicks',
    ];

    protected $appends = [
        'icon',
        'external_link'
    ];

    /**
     * Get all of the owning linkable models.
     */
    public function linkable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function getIconAttribute()
    {
        $url = parse_url(strtolower($this->url));
        if (isset($url['host'])) {
            $explode = explode('.', $url['host']);
            $icon = count($explode) >= 3 ? $explode[1] : $explode[0];

            return isset($this->icons[$icon]) ? $this->icons[$icon] : $this->icons['default'];
        }

        return $this->icons['default'];
    }

    /**
     * @return string
     */
    public function getExternalLinkAttribute()
    {
        return route('links.show', \Hashids::encode($this->id));
    }

    /**
     *
     */
    public function clicked()
    {
        $this->increment('clicks');
    }
}
