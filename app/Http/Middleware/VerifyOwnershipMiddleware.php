<?php

namespace App\Http\Middleware;

use App\Exceptions\Event\EventNotFoundException;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws EventNotFoundException
     */
    public function handle(Request $request, Closure $next): Response
    {

        $event = $request->route('event');

        if (!$event instanceof Event || Auth::user()->id !== $event->user_id) {
            throw new EventNotFoundException();
        }

        return $next($request);
    }
}
