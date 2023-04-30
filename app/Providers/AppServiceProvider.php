<?php

namespace App\Providers;

use App\Components\InputComponent;
use App\Components\SelectComponent;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind( UserRepositoryInterface::class, UserRepository::class );
        $this->app->bind( ContactRepositoryInterface::class, ContactRepository::class );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component( 'input', InputComponent::class );
        Blade::component( 'select', SelectComponent::class );
    }
}
