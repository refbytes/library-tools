<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscriptions\LocationRequest;
use App\Http\Resources\Subscriptions\LocationResource;
use App\Models\Subscriptions\Location;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Location::class);

        return LocationResource::collection(Location::all());
    }

    public function store(LocationRequest $request)
    {
        $this->authorize('create', Location::class);

        return new LocationResource(Location::create($request->validated()));
    }

    public function show(Location $location)
    {
        $this->authorize('view', $location);

        return new LocationResource($location);
    }

    public function update(LocationRequest $request, Location $location)
    {
        $this->authorize('update', $location);

        $location->update($request->validated());

        return new LocationResource($location);
    }

    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);

        $location->delete();

        return response()->json();
    }
}
