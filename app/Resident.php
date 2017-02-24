<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nik', 'gender', 'date_of_birth', 'hometown_id',
        'job_id', 'education_id', 'marital_status_id',
    ];

    /**
     * The attributes casted to Carbon\Carbon object
     *
     * @var array
     */
    protected $dates = [
        'date_of_birth',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'age',
    ];

    /**
     * Get the age of the resident.
     *
     * @return integer
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth->diffInYears();
    }

    /**
     * Scope a query to only include resident that is patriarch.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBalita($query)
    {
        return $query->where('date_of_birth', '>=', Carbon::now()->addYears(-5));
    }

    /**
     * Scope a query to only include resident that is patriarch.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAnakAnak($query)
    {
        return $query->where('date_of_birth', '>=', Carbon::now()->addYears(-15))
            ->where('date_of_birth', '<', Carbon::now()->addYears(-5));
    }

    /**
     * Scope a query to only include resident that is patriarch.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRemaja($query)
    {
        return $query->where('date_of_birth', '>=', Carbon::now()->addYears(-21))
            ->where('date_of_birth', '<', Carbon::now()->addYears(-15));
    }

    /**
     * Scope a query to only include resident that is patriarch.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProduktif($query)
    {
        return $query->where('date_of_birth', '>=', Carbon::now()->addYears(-50))
            ->where('date_of_birth', '<', Carbon::now()->addYears(-21));
    }

    /**
     * Scope a query to only include resident that is patriarch.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLansia($query)
    {
        return $query->where('date_of_birth', '<', Carbon::now()->addYears(-50));
    }

    /**
     * Scope a query to only include resident that is men.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMen($query)
    {
        return $query->where('gender', 'L');
    }

    /**
     * Scope a query to only include resident that is women.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWomen($query)
    {
        return $query->where('gender', 'P');
    }

    /**
     * Scope a query to only include resident in kadus.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKadus($query, $kadus)
    {
        return $query->whereHas('familyCards', function ($query) use ($kadus) {
            $query->where('kadus', $kadus);
        }, '>', 0);
    }

    /**
     * Scope a query to only include resident in rt.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRT($query, $rt)
    {
        return $query->whereHas('familyCards', function ($query) use ($rt) {
            $query->where('rt', $rt);
        }, '>', 0);
    }

    /**
     * Scope a query to only include resident in rw.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRW($query, $rw)
    {
        return $query->whereHas('familyCards', function ($query) use ($rw) {
            $query->where('rw', $rw);
        }, '>', 0)->orHas('familyCards', null, '=', 0);
    }

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
        return $this->familyCards()->latest()->first();
    }

    /**
     * Get the hometown (district) that the resident belong to.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function hometown()
    {
        return $this->belongsTo(District::class);
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

    /**
     * Determine if the resident is patriarch or not.
     *
     * @return boolean
     */
    public function amIPatriarch()
    {
        if (! is_null($this->familyCard())) {
            return $this->attributes['id'] === $this->familyCard()->patriarch->id;
        }

        return false;
    }
}
