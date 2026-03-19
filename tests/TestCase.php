<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Tests;

use MasterRO\AccessScreen\AccessScreenServiceProvider;
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
        $app['config']->set('access-screen.access_key', 'test-key');
        $app['config']->set('access-screen.uri', 'get-access');
        $app['config']->set('access-screen.except', []);
    }
}
