<?php

namespace App\Providers;

use App\Models\Restaurant;
use App\Policies\RestaurantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Restaurant::class => RestaurantPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
