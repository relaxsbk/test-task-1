<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEventLeave
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $event = $request->route('event');

        if (!$user->joinedEvents()->where('event_id', $event->id)->exists()) {
            return response()->json([
                'message' => 'You cannot exit an event that you are not participating in'
            ], 400);
        }

        return $next($request);
    }
}
