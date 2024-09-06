<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Event\MiniEventResource;
use App\Http\Resources\Event\UserEventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $events = Event::query()
            ->orderByDesc('id')
            ->orderByDesc('created_at')
            ->paginate(15);

      return MiniEventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function showUserEvents(Request $request, Event $event)
    {
//        $userID = $request->user()->id;
//
//       $eventsUser = Event::query()
//           ->where('user_id', $userID)
//           ->orderByDesc('id')
//           ->orderByDesc('created_at')
//           ->paginate(10);
//
//       return UserEventResource::collection($eventsUser);
        $user = $request->user();// Получаем текущего аутентифицированного пользователя

        $events = $user->createdEvents()->paginate(10); // Используйте связь createdEvents в модели User

        return UserEventResource::collection($events);
    }
}
