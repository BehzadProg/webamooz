<?php

namespace Beh7ad\User\Providers;

use Beh7ad\User\Database\seeders\DatabaseSeeder;
use Beh7ad\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

Class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        config()->set('auth.providers.users.model' , User::class);
    }


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'User');
        // Factory::load(__DIR__.'/../Database/factories');
        // Factory::factory()->load(__DIR__.'/../Database/factories');
        // Seeder::call(DatabaseSeeder::class);
    }
}
