<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyOwnershipMiddleware;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Event\MiniEventResource;
use App\Http\Resources\Event\UserEventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      $events = Event::query()
            ->orderByDesc('id')
            ->orderByDesc('created_at')
            ->paginate(15);

      return MiniEventResource::collection($events);
    }


    public function store(StoreEventRequest $request)
    {
        /**
         * @var Event $event
         */
        $event = \auth()->user()->events()->create($request->validated());

        return $this->show($event);
    }


    public function show(Event $event)
    {
        return new EventResource($event);
    }


    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return $this->show($event->fresh());
    }


    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'message' => 'event deleted successfully'
        ]);
    }

    public function showUserEvents(Request $request)
    {
        $user = $request->user();

        $events = $user->createdEvents()->paginate(10); // связь createdEvents в модели User

        return UserEventResource::collection($events);
    }
}
