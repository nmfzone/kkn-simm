<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
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
     * The residents that belong to the disability.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function residents()
    {
        return $this->belongsToMany(Resident::class);
    }

    /**
     * Get residents that has specific disability.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function residentsWhoHave(Disability $disability)
    {
        return $this->residents()->wherePivot('disability_id', $disability->id);
    }

    /**
     * Get total of the resident that has disability.
     *
     * @return integer
     */
    public function getResidentsTotalAttribute()
    {
        return $this->residents()->count();
    }
}
