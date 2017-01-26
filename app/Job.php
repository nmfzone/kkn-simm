<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the family cards for the job.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function familyCards()
    {
        return $this->hasMany(FamilyCard::class);
    }
}
