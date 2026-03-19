<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Tests;

use MasterRO\AccessScreen\AccessScreenServiceProvider;
use MasterRO\AccessScreen\Middleware\RedirectToAccessScreen;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AccessScreenServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('access-screen.access_key', 'test-key');
        $app['config']->set('access-screen.uri', 'get-access');
        $app['config']->set('access-screen.except', []);
    }

    protected function defineRoutes($router): void
    {
        $router->get('/protected', fn () => response('OK'))
            ->middleware(RedirectToAccessScreen::class);

        $router->get('/webhook', fn () => response('OK'))
            ->middleware(RedirectToAccessScreen::class);

        $router->get('/health', fn () => response('OK'))
            ->middleware(RedirectToAccessScreen::class);
    }
}
