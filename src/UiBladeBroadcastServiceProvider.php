<?php

namespace Exit11\UiBlade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class UiBladeBroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();
        require(__DIR__ . '/../routes/channels.php');
    }
}
