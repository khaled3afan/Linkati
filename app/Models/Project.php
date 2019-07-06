<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Get all of the project's links.
     */
    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }
}
