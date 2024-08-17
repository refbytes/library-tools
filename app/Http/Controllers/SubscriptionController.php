<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscriptions\Subscription;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Subscription::class);

        return SubscriptionResource::collection(
            Subscription::query()
                ->with([
                    'formats',
                    'providers',
                    'proxy',
                    'subjects',
                    'vendor',
                    'media',
                ])
                ->get()
        );
    }

    public function store(SubscriptionRequest $request)
    {
        $this->authorize('create', Subscription::class);

        return new SubscriptionResource(Subscription::create($request->validated()));
    }

    public function show(Subscription $subscription)
    {
        $this->authorize('view', $subscription);

        return new SubscriptionResource($subscription);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $this->authorize('update', $subscription);

        $subscription->update($request->validated());

        return new SubscriptionResource($subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);

        $subscription->delete();

        return response()->json();
    }
}
