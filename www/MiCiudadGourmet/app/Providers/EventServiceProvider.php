<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // 'event.name' => [Listener::class],
    ];

    public function boot(): void
    {
        //
    }
}
