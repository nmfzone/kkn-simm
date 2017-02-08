<?php

namespace App\Services;

use App\User;

interface UserService
{
    /**
     * Attach ability to the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function attachAbility(User $user);

    /**
     * Detach ability from the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function detachAbility(User $user);

    /**
     * Store user photo to the storage.
     *
     * @param  mixed  $media
     * @param  \App\User  $user
     * @return void
     */
    public function storeMedia();
}
