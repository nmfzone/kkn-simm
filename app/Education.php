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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'residentsTotal',
    ];

    /**
     * Get the residents for the education.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    /**
     * Get residents that has specific education.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function residentsWhoHave(Education $education)
    {
        return $this->residents()->where('education_id', $education->id);
    }

    /**
     * Get total of the resident that has education.
     *
     * @return integer
     */
    public function getResidentsTotalAttribute()
    {
        return $this->residents()->count();
    }
}
