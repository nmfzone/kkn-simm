<?php

namespace App\Observers;

use App\User;
use App\Services\UserService;

class UserObserver
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * Constructor.
     *
     * @param  \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Listen to the User created event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        $permissions = require resource_path('roles/defaults.php');

        $user->allow($permissions[get_class($user)]);
        $this->userService->attachAbility($user);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function deleting(User $user)
    {
        $this->userService->detachAbility($user);
    }
}
