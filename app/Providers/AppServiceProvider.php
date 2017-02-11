<?php

namespace App\Providers;

use App;
use App\Observers;
use App\Services;
use Illuminate\Support\Facades\{Hash, Validator};
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database;
use Symfony\Component\Finder\Finder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoles();
        $this->registerEloquentObservers();
        $this->registerCustomValidations();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Services\UserService::class,
            Services\Implementations\UserServiceImplementation::class
        );
    }

    /**
     * Register observers with the Models.
     *
     * @return void
     */
    protected function registerEloquentObservers()
    {
        App\User::observe(Observers\UserObserver::class);
    }

    /**
     * Register custom validation rules.
     *
     * @return void
     */
    protected function registerCustomValidations()
    {
        Validator::extend('old_password', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });
    }

    /**
     * Register the application's roles and permissions.
     *
     * @return void
     */
    protected function registerRoles()
    {
        if (! is_dir($path = resource_path('roles'))) {
            return;
        }

        $files = Finder::create()
            ->in($path)
            ->name('*.php')
            ->notName('defaults.php');

        $bouncer = app(Bouncer::class);
        $bouncer->seeder(function () use ($bouncer, $files) {
            collect($files)->each(function ($file) use ($bouncer) {
                $role = require $file->getRealPath();
                $name = $role['name'];
                $permissions = $role['permissions'];

                $bouncer->allow("$name")->to($permissions);
            });
        });
    }
}
