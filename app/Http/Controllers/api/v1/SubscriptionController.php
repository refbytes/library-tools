<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscriptions\Subscription;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $validated = $request->validated();

        $resource = DB::transaction(function () use ($validated) {

            $resource = new SubscriptionResource(
                Subscription::create($validated)
            );

            return $resource;
        });

        return $resource;
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
