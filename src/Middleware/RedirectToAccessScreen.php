<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\Concerns\ExcludesPaths;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RedirectToAccessScreen
{
    use ExcludesPaths;

    protected array $except = [];

    protected static array $ignore = [];

    public function handle(Request $request, Closure $next)
    {
        if ($this->inExceptArray($request) || $this->keyMatch($request)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            abort(403);
        }

        return redirect()->guest(route('access-screen::index'));
    }

    protected function keyMatch(Request $request): bool
    {
        $key = $request->cookie('access_screen_key')
            ?? $request->header('X-ACCESS_SCREEN-KEY')
            ?? $request->input('access_screen_key');

        return $key === config('access-screen.access_key');
    }

    public function getExcludedPaths(): array
    {
        return [
            ...$this->except,
            ...static::$ignore,
            ...config('access-screen.except', []),
            config('access-screen.uri'),
        ];
    }

    public static function except($uris): void
    {
        static::$ignore = array_values(array_unique([
            ...static::$ignore,
            ...Arr::wrap($uris),
        ]));
    }
}
