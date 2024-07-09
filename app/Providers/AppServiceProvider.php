<?php

namespace App\Providers;

use App\Models\JuntaPanelas;
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
        Gate::define('update-participant', function (User $user, string $participantId) {
            $userId = JuntaPanelas::where('participants._id', $participantId)->value('user_id');
            return $user->id === $userId;
        });

        Gate::define('delete-participant', function (User $user, string $participantId) {
            $userId = JuntaPanelas::where('participants._id', $participantId)->value('user_id');
            return $user->id === $userId;
        });
    }
}
