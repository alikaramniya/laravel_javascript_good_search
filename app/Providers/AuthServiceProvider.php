<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function(User $user, $ability, $param) {

        });

        Gate::define('update-post', function (User $user, Post $post, $message, $lastName) {
            echo $lastName;
            return $user->id === $post->user_id;
        });
    }
}
