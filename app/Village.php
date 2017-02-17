<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
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
        'name', 'sub_district_id',
    ];

    /**
     * Get the family cards for the village.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function familyCards()
    {
        return $this->hasMany(FamilyCard::class);
    }

    /**
     * Get the sub district that the village belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }
}
