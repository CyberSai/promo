<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeactivatePromoRequest;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\VerifyPromoRequest;
use App\Http\Resources\PromoResource;
use App\Http\Resources\VerifiedPromoResource;
use App\Models\Event;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PromoController extends Controller
{
    public function index(Event $event)
    {
        $promos = $event->promos()->simplePaginate();

        return PromoResource::collection($promos);
    }

    public function store(StorePromoRequest $request, Event $event)
    {
        $promo = $event->promos()->create($request->validated());

        return new PromoResource($promo->refresh());
    }

    public function deactivate(DeactivatePromoRequest $request)
    {
        $promo = Promo::query()->where('code', $request->post('code'))->first();

        $promo->update(['active' => false,]);

        return response()->noContent();
    }

    public function active(Event $event)
    {
        $activePromos = $event->promos()->where('active', true)->simplePaginate();

        return PromoResource::collection($activePromos);
    }

    public function verify(VerifyPromoRequest $request)
    {
        $validated = $request->validated();

        $promo = Promo::query()->where('code', $validated['code'])->first();

        if (!$promo->active) {
            throw ValidationException::withMessages([
                'inactive' => 'Promo Code has been deactivated',
            ]);
        }

        if ($promo->isExpired()) {
            throw ValidationException::withMessages([
                'expired' => 'Promo Code has expired since event is in the past',
            ]);
        }

        if (!$promo->withinRadius($validated['origin']) && !$promo->withinRadius($validated['destination'])) {
            throw ValidationException::withMessages([
                'radius' => 'You are not within the radius of the event',
            ]);
        }

        $polyline = $promo->createPolyline($validated['origin'], $validated['destination']);

        return new VerifiedPromoResource($promo, $polyline);
    }
}
