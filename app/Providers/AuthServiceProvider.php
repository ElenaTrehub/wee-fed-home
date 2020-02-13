<?php

namespace App\Providers;

use App\Filters\RecipeFilter;
use App\Models\Comment;
use App\Models\CookerBook;
use App\Models\Message;
use App\Models\Recipe;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\CookerBookPolicy;
use App\Policies\MessagePolicy;
use App\Policies\RecipePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Recipe::class => RecipePolicy::class,
        Comment::class => CommentPolicy::class,
        CookerBook::class=>CookerBookPolicy::class,
        User::class=>UserPolicy::class,
        Message::class=>MessagePolicy::class
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }



}
