<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen;

use Illuminate\Support\ServiceProvider;
use MasterRO\AccessScreen\Commands\AccessKeyCommand;
use MasterRO\AccessScreen\Commands\PublishCommand;

class AccessScreenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            PublishCommand::class,
            AccessKeyCommand::class,
        ]);
    }

    public function boot(): void
    {
        $this->publish();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/access-screen.php',
            'access-screen',
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'access-screen');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../config/access-screen.php' => config_path('access-screen.php'),
        ], 'access-screen-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/access-screen'),
        ], ['access-screen-views']);

        $this->publishes([
            __DIR__ . '/../public/' => public_path('vendor/access-screen'),
        ], ['access-screen-assets', 'laravel-assets']);
    }
}
