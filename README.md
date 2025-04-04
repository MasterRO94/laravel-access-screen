# Access Screen for Laravel

<p align="center">
  <img width="471" height="510" src="https://github.com/MasterRO94/laravel-access-screen/blob/main/resources/assets/demo.png">
</p>

<p align="center">
    <a href="https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md">
        <img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg" alt="StandWithUkraine">
    </a>
</p>

## Introduction

Access Screen for Laravel is a package that allows you to guard specific routes or an entire Laravel application with an access screen. Users must enter an access key to proceed, and the package provides a command to generate this key. Once a valid key is entered, the screen will not be shown again for a specified period of time.

## Installation

Install the package via Composer:

```bash
composer require masterro/laravel-access-screen
```

## Configuration

Publish the configuration file:

```bash
php artisan access-screen:publish
```

This will create a `config/access-screen.php` file where you can customize the package behavior.

### Available Configuration Options

```php
return [
    'access_key' => env('ACCESS_SCREEN_KEY', 'REPLACE_WITH_ACCESS_KEY'),
    'lifetime' => env('ACCESS_SCREEN_KEY_LIFETIME'), // minutes
    'app_name' => env('ACCESS_SCREEN_APP_NAME', env('APP_NAME')),
    'except' => [], // URIs to exclude from access screen.
    'middleware' => ['web'],
    'uri' => env('ACCESS_SCREEN_URI', 'get-access'),
    'title_line1' => env('ACCESS_SCREEN_TITLE_LINE1', 'Please enter the key'),
    'title_line2' => env('ACCESS_SCREEN_TITLE_LINE2', 'to access the application'),
    'description' => env(
        'ACCESS_SCREEN_DESCRIPTION',
        'To proceed using the application, please enter a valid access key below.',
    ),
    'input_type' => env('ACCESS_SCREEN_INPUT_TYPE', 'text'),
];
```

## Usage

### Protecting Routes

To protect specific routes, apply the middleware to them:

```php
use MasterRO\AccessScreen\Middleware\RedirectToAccessScreen;

Route::middleware([RedirectToAccessScreen::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### Protecting the Entire Application

To guard the entire application, apply the middleware globally in `bootstrap/app.php`:

```php
$app
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web', [RedirectToAccessScreen::class]);
    })
```

## Generating an Access Key

Use the following Artisan command to generate an access key:

```bash
php artisan access-screen:key --generate
```

## Excluding Certain Routes

To exclude specific URIs from the access screen, update the `except` array in `config/access-screen.php`:

```php
'except' => [
    'login',
    'register',
],
```

## Customizing the Access Screen

You can customize the appearance and messaging of the access screen using the configuration options:

- `title_line1`: First line of the title.
- `title_line2`: Second line of the title.
- `description`: Description text.
- `input_type`: Input type (e.g., `text`, `password`).

## License

This package is open-source and available under the MIT license.

