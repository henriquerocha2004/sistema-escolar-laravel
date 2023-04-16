<?php

namespace App\Providers;

use App\Http\Livewire\ClassRoom\Index;
use App\Repository\ClassRoomRepository;
use App\School\Secretary\Actions\ClassRoomActions;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ClassRoomActions::class, function ($app) {
            return new ClassRoomActions(
                $app->make(ClassRoomRepository::class)
            );
        });

        $this->app->singleton(Index::class, function ($app) {
            return new Index(
                $app->make(ClassRoomActions::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
