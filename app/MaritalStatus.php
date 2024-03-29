<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
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
     * Get the residents for the marital status.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
