<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Resources\ListResource;
use App\Models\Subscriptions\SubscriptionList;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', SubscriptionList::class);

        return ListResource::collection(
            SubscriptionList::query()
                ->with([
                    'subscriptions',
                ])
                ->get()
        );
    }

    public function store(ListRequest $request)
    {
        $this->authorize('create', SubscriptionList::class);

        return new ListResource(SubscriptionList::create($request->validated()));
    }

    public function show(SubscriptionList $list)
    {
        $this->authorize('view', $list);

        return new ListResource($list);
    }

    public function update(ListRequest $request, SubscriptionList $list)
    {
        $this->authorize('update', $list);

        $list->update($request->validated());

        return new ListResource($list);
    }

    public function destroy(SubscriptionList $list)
    {
        $this->authorize('delete', $list);

        $list->delete();

        return response()->json();
    }
}
