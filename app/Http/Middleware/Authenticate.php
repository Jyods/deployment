<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : abort(401, 'Unauthenticated.');
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request  $request
     * @param array  $guards
     * @return \Illuminate\Http\JsonResponse
     */
    /*protected function unauthenticated($request, array $guards)
    {
        return new JsonResponse(['error' => 'Unauthenticated.'], 401);
    }*/
}
