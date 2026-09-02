<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * Liga as permissões do SNRP ao sistema de Gates
         * utilizado pelo @can() nas views Blade.
         *
         * Quando a capacidade corresponde a uma permissão
         * existente no sistema, o método hasPermission()
         * do utilizador determina o acesso.
         */
        Gate::before(function (User $user, string $ability) {

            if ($user->hasPermission($ability)) {
                return true;
            }

            return null;
        });
    }
}
