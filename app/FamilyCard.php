<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'address', 'rt', 'rw', 'issued_on'
    ];

    /**
     * Get the village that the family card belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * The residents that belong to the family card.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Resident::class, 'family_card_member', 'family_card_id', 'resident_id');
    }

    /**
     * Get the patriarch of the family card.
     *
     * @return \App\Resident|null
     */
    public function patriarch()
    {
        return $this->members()
            ->where('is_patriarch', true)
            ->first();
    }
}
