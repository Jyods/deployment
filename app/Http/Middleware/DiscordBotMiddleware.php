<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiscordBotMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $discordToken = $request->header('Authorization');
        $botToken = 'ODIxMTE3MTU4MDEyMzU0NTcw.GVQnOh.48BhqMb1fkYZAkcP2VXpnbOOxBM1AutOPl0vo0';

        if ($discordToken !== 'Bearer '.$botToken) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
