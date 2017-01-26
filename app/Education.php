<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the family cards for the education.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function familyCards()
    {
        return $this->hasMany(FamilyCard::class);
    }
}
