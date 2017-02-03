<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
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
        'name', 'postal_code'
    ];

    /**
     * Get the villages for the sub district.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    /**
     * Get the district that the sub district belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
