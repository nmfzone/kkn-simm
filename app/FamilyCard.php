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
        'number', 'dukuh', 'rt', 'rw', 'issued_on', 'village_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'patriarch',
        'nonPatriarch'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'members',
        'village',
    ];

    /**
     * Scope a query to only include family cards in dukuh.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDukuh($query, $dukuh)
    {
        return $query->where('dukuh', $dukuh);
    }

    /**
     * Scope a query to only include family cards in rt.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRT($query, $rt)
    {
        return $query->where('rt', $rt);
    }

    /**
     * Scope a query to only include family cards in rw.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRW($query, $rw)
    {
        return $query->where('rw', $rw);
    }

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
     * @return \App\FamilyCard|null
     */
    public function getPatriarchAttribute()
    {
        return $this->members()
            ->wherePivot('is_patriarch', true)
            ->first();
    }

    /**
     * Get the members of the family card that is not a patriarch.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getNonPatriarchAttribute()
    {
        return $this->members()
            ->wherePivot('is_patriarch', false)
            ->get();
    }

    /**
     * Get total of the member's family card (without patriarch).
     *
     * @return integer
     */
    public function memberTotal()
    {
        return ($total = $this->members()->count()) > 0
            ? $total-1
            : 0;
    }
}
