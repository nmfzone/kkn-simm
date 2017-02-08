<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth_date', 'is_patriarch',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_patriarch' => 'boolean',
    ];

    /**
     * The attributes casted to Carbon\Carbon object
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
    ];

    /**
     * Get the resident's photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * The family cards that belong to the resident.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function familyCards()
    {
        return $this->belongsToMany(FamilyCard::class, 'family_card_member', 'resident_id', 'family_card_id');
    }

    /**
     * Get the latest family card that belong to the resident.
     *
     * @return \App\FamilyCard|null
     */
    public function familyCard()
    {
        return $this->familyCards()->latest();
    }

    /**
     * Get the job that the resident belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the education that the resident belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    /**
     * Get the marital status that the resident belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    /**
     * The disabilities that belong to the resident.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function disabilities()
    {
        return $this->belongsToMany(Disability::class);
    }
}
