<?php

declare(strict_types=1);

it('redirects to access screen when no key is provided', function () {
    $this->get('/protected')
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

it('returns validation error for missing key', function () {
    $this->post(route('access-screen::store'), [])
        ->assertSessionHasErrors('access_key');
});

it('allows access when valid key header is present', function () {
    $this->withHeader('X-ACCESS_SCREEN-KEY', 'test-key')
        ->get('/protected')
        ->assertOk();
});

it('allows access when valid key is provided as query parameter', function () {
    $this->get('/protected?access_screen_key=test-key')
        ->assertOk();
});

it('aborts with 403 for json requests without valid key', function () {
    $this->getJson('/protected')
        ->assertForbidden();
});
