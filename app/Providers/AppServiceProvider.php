<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void {}
=======
use App\Http\Responses\LogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    public function boot(): void
    {
        Livewire::component('candidate.dashboard-component', \App\Livewire\Candidate\DashboardComponent::class);
        Livewire::component('candidate.take-test-component', \App\Livewire\Candidate\TakeTestComponent::class);

        Gate::define('view-translation-manager', function () {
            return true;
        });

        Gate::define('view-candidate-scores', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('edit-candidate-status', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-all-applications', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('send-candidate-notification', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('download-candidate-cv', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-test-results-detail', function ($user) {
            return $user->hasRole('admin');
        });
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}