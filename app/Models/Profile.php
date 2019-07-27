<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Profile extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'theme_id',
        'name',
        'username',
        'location',
        'bio',
    ];

    protected $appends = [
        'avatar_url',
        'route',
    ];

    protected $with = [
        'links',
        'theme',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * @return mixed
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->hasMedia('avatar')) {
            return $this->getFirstMedia('avatar')->getUrl('cropped');
        }

        return asset('/images/avatar.png');
    }

    /**
     * @return mixed
     */
    public function getRouteAttribute()
    {
        return route('profiles.show', $this);
    }

    /**
     * Get all of the profile's links.
     *
     * @param string $order
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function links($order = 'asc')
    {
        return $this->morphMany(Link::class, 'linkable')->orderBy('order', $order);
    }

    /**
     * Get profile theme.
     *
     * @param string $order
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     *
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    /**
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('cropped')
             ->crop(Manipulations::CROP_CENTER, 200, 200)
             ->nonQueued()
             ->performOnCollections('avatar');
    }
}
