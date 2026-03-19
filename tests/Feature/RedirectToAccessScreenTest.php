<?php

declare(strict_types=1);

use MasterRO\AccessScreen\Middleware\RedirectToAccessScreen;

it('excludes uris via static except method', function () {
    RedirectToAccessScreen::except('/webhook');

    $this->get('/webhook')
        ->assertOk();
});

it('excludes uris configured in config except array', function () {
    config(['access-screen.except' => ['/health']]);

    $this->get('/health')
        ->assertOk();
});
