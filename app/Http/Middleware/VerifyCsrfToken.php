<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'auth/facebook/callback',
        'auth/google/callback',
        '/sanctum/token',
        '/auth/google',
        '/api/post',
        'follow/*/*'
    ];
}
