<?php

namespace App\Services\Implementations;

use App\Services\PostService;
use App\{Post, User};
use Illuminate\Support\Facades\Storage;
use Silber\Bouncer\BouncerFacade as Bouncer;

class PostServiceImplementation extends BaseService implements PostService
{
    /**
     * Attach ability for post to the appropriate user.
     *
     * @param  \App\Post  $post
     * @param  \App\User  $user
     * @return void
     */
    public function attachAbility(Post $post, User $user)
    {
        // Attach ability to the Administrator role.
        Bouncer::allow('Administrator')->toManage($post);

        // Attach ability to the user.
        Bouncer::allow($user)->toManage($post);

        // Attach ability to the user followers.
        $user->followers->each(function ($user) use ($post) {
            Bouncer::allow($user)->to('like-dislike', $post);
            Bouncer::allow($user)->to('view', $post);
        });
    }

    /**
     * Detach ability for post from the appropriate user.
     *
     * @param  \App\Post  $post
     * @param  \App\User  $user
     * @return void
     */
    public function detachAbility(Post $post, User $user)
    {
        // Detach ability from the Administrator role.
        Bouncer::disallow('Administrator')->toManage($post);

        // Detach ability from the user.
        Bouncer::disallow($user)->toManage($post);

        // Detach ability from the user followers.
        $user->followers->each(function ($user) use ($post) {
            Bouncer::disallow($user)->to('like-dislike', $post);
            Bouncer::disallow($user)->to('view', $post);
        });
    }

    /**
     * Store post media to the storage.
     *
     * @param  mixed  $media
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return void
     */
    public function storeMedia()
    {
        $args = func_get_args();
        $this->checkParameters($args, 3);

        $media = $args[0];
        $user = $args[1];
        $post = $args[2];

        if ($location = $media->store('media/' . $user->id . '/post', 'public')) {
            $file = parent::storeMedia($media, $location, $user);
            $post->file()->save($file);
        }
    }

    /**
     * Destroy post media from the storage.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function destroyMedia(Post $post)
    {
        if (! is_null($post->file)) {
            Storage::disk('public')->delete($post->file->location);
            $post->file->delete();
        }
    }
}
