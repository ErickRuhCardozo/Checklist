<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Place;
use App\Models\Unity;
use App\Policies\PlacePolicy;
use App\Policies\UnityPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Unity::class => UnityPolicy::class,
        Place::class => PlacePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
