<?php

namespace Tests\Feature;

use App\Http\Controllers\EventController;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_return_paginated_events_with_recently_created_first()
    {
        Event::factory()->count(50)->create();

        $recentEvents = Event::query()->latest()->take(15)->get()->map(function ($value) {
            return json_decode((new EventResource($value))->toJson(), true);
        })->toArray();

        $response = $this->get(route('events.index'));

        $response->assertOk()
            ->assertJsonCount(15, 'data')
            ->assertJson(['data' => $recentEvents]);
    }

    public function test_store_uses_form_request_meant_for_event_validation()
    {
        $this->assertActionUsesFormRequest(
            EventController::class,
            'store',
            StoreEventRequest::class
        );
    }

    public function test_validation_rules_for_store_event_request_is_correct()
    {
        $this->assertValidationRules([
            'name' => ['required', 'string', 'max:255',],
            'description' => ['nullable', 'string',],
            'date' => ['required', 'date'],
            'coordinate.lat' => ['required', 'numeric',],
            'coordinate.lng' => ['required', 'numeric',],
        ], (new StoreEventRequest())->rules());
    }

    public function test_store_saves_event_and_returns_a_response()
    {
        $event = Event::factory()->raw();
        $event['coordinate'] = [
            'lat' => $event['coordinate']->getLat(),
            'lng' => $event['coordinate']->getLng(),
        ];

        $response = $this->postJson(route('events.store'), $event);

        $response->assertCreated()
            ->assertJson(['data' => $event]);
    }
}
