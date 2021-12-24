<?php

namespace Exit11\UiBlade;

use Exit11\UiBlade\Models;
use Exit11\UiBlade\Policies;
use Mpcs\Core\Facades\Core;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class UiBladeAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 
        Models\Menu::class => Policies\MenuPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Auth
        Auth::shouldUse(Core::getConfig('auth_guard'));
        $this->registerPolicies();
    }
}
