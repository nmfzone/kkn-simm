<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    /**
     * Get the job that owns the family card.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the education that owns the family card.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    /**
     * Get the village that owns the family card.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
