<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
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
     * Get the districts for the province.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
