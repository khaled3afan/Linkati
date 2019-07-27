<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Theme extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'settings',
        'is_pro',
    ];

    protected $casts = [
        'settings' => 'json',
        'is_pro' => 'boolean',
    ];

    protected $appends = [
        'thumbnail',
    ];

    /**
     * The profiles that belong to the theme.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * @return mixed
     */
    public function getThumbnailAttribute()
    {
        return $this->getFirstMedia('thumbnail')->getFullUrl();
    }

    /**
     *
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }
}
