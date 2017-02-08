<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The residents that belong to the disability.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function residents()
    {
        return $this->belongsToMany(Resident::class);
    }
}
