<?php

namespace App\Services\Implementations;

use App\Services\UserService;
use App\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserServiceImplementation extends BaseService implements UserService
{
    /**
     * Attach ability to the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function attachAbility(User $user)
    {
        // Attach ability to the Administrator role.
        Bouncer::allow('Administrator')->toManage($user);

        // Attach ability to the user.
        Bouncer::allow($user)->toManage($user);
    }

    /**
     * Detach ability from the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function detachAbility(User $user)
    {
        // Detach ability from the Administrator role.
        Bouncer::disallow('Administrator')->toManage($user);

        // Detach ability from the user.
        Bouncer::disallow($user)->toManage($user);
    }

    /**
     * Store user photo to the storage.
     *
     * @param  mixed  $media
     * @param  \App\User  $user
     * @return void
     */
    public function storeMedia()
    {
        $args = func_get_args();
        $this->checkParameters($args, 2);

        $media = $args[0];
        $user = $args[1];

        if ($location = $media->store('media/' . $user->id . '/profile', 'public')) {
            $user->photo_url = $location;
            $user->save();
        }
    }
}
