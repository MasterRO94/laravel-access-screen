<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Cookie;

it('redirects to access screen when no key is provided', function () {
    $this->get('/')
        ->assertRedirect(route('access-screen::index'));
});

it('shows the access screen form', function () {
    $this->get(route('access-screen::index'))
        ->assertOk();
});

it('redirects to intended url after valid key submission', function () {
    $this->post(route('access-screen::store'), ['access_key' => 'test-key'])
        ->assertRedirect('/');
});

it('returns validation error for invalid key', function () {
    $this->post(route('access-screen::store'), ['access_key' => 'wrong-key'])
        ->assertSessionHasErrors('access_key');
});

it('returns 422 for missing key', function () {
    $this->post(route('access-screen::store'), [])
        ->assertSessionHasErrors('access_key');
});

it('allows access when valid cookie is present', function () {
    $this->withCookie('access_screen_key', 'test-key')
        ->get('/')
        ->assertOk();
});

it('aborts with 403 for json requests without valid key', function () {
    $this->getJson('/')
        ->assertForbidden();
});
