<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Get the location attribute.
     *
     * @param string|null $value
     * @return string
     */
    public function getLocationAttribute($value)
    {
        return url(Storage::disk('public')->url($value));
    }

    /**
     * Get all of the owning fileable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
