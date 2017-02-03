<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
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
     * Get the sub districts for the district.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class);
    }

    /**
     * Get the province that the district belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
