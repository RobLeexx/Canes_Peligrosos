<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            // Synchronously
            'appName' => config('app.username'),
            // Lazily
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id','username', 'rol', 'email', 'paterno', 'materno', 'nombres', 'numContacto', 'grado', 'departamento', 'director')
                : null
        ]);
    }
}
use Inertia\Inertia;

// Synchronously
Inertia::share('appName', config('app.name'));

// Lazily
Inertia::share('user', fn (Request $request) => $request->user()
    ? $request->user()->only('id','username', 'rol', 'email', 'paterno', 'materno', 'nombres', 'numContacto', 'grado', 'departamento', 'director')
    : null
);
