<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardMember extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'family_card_member';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_patriarch' => 'boolean',
    ];
}
