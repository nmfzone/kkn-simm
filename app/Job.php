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
     * Get the residents for the job.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    /**
     * Get residents that has specific job.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function residentsWhoHave(Job $job)
    {
        return $this->residents()->where('job_id', $job->id);
    }

    /**
     * Get total of the resident that has job.
     *
     * @return integer
     */
    public function getResidentsTotalAttribute()
    {
        return $this->residents()->count();
    }
}
