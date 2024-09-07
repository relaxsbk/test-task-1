<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEventParticipation
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


        if ($user->joinedEvents()->where('event_id', $event->id)->exists()) {
            return \response()->json([
                'message' => 'You are already participating in this event'
            ], 403);
        }
        return $next($request);
    }
}
