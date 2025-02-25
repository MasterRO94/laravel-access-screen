<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AccessScreenController extends Controller
{
    public function index(): View
    {
        return view('access-screen::index');
    }

    public function store(Request $request)
    {
        ['access_key' => $key] = $request->validate([
            'access_key' => ['required', 'string'],
        ]);

        if ($key !== config('access-screen.access_key')) {
            throw ValidationException::withMessages([
                'access_key' => ['The provided access key is invalid.'],
            ]);
        }

        Cookie::queue(
            'access_screen_key',
            $key,
            config('access-screen.lifetime') ?? 60 * 24 * 365,
        );

        return redirect()->intended(url('/'));
    }
}
