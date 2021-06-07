<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()->latest()->simplePaginate();

        return EventResource::collection($events);
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::query()->create($request->validated());

        return new EventResource($event->refresh());
    }
}
