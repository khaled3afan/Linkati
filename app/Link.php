<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    const TYPE_NORMAL = 0;

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

    /**
     * Get all of the owning linkable models.
     */
    public function linkable()
    {
        return $this->morphTo();
    }
}
