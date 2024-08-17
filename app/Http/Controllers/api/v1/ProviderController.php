<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscriptions\ProviderRequest;
use App\Http\Resources\Subscriptions\ProviderResource;
use App\Models\Subscriptions\Provider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProviderController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Provider::class);

        return ProviderResource::collection(Provider::all());
    }

    public function store(ProviderRequest $request)
    {
        $this->authorize('create', Provider::class);

        return new ProviderResource(Provider::create($request->validated()));
    }

    public function show(Provider $provider)
    {
        $this->authorize('view', $provider);

        return new ProviderResource($provider);
    }

    public function update(ProviderRequest $request, Provider $provider)
    {
        $this->authorize('update', $provider);

        $provider->update($request->validated());

        return new ProviderResource($provider);
    }

    public function destroy(Provider $provider)
    {
        $this->authorize('delete', $provider);

        $provider->delete();

        return response()->json();
    }
}
