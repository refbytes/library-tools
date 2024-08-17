<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscriptions\AuthenticationRequest;
use App\Http\Resources\Subscriptions\AuthenticationResource;
use App\Models\Subscriptions\Authentication;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthenticationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Authentication::class);

        return AuthenticationResource::collection(Authentication::all());
    }

    public function storeVendorAuthentication(AuthenticationRequest $request, Vendor $vendor)
    {
        $this->authorize('create', Authentication::class);

        return new AuthenticationResource(Authentication::create($request->validated()));
    }

    public function storeSubscriptionAuthentication(AuthenticationRequest $request, Subscription $subscription)
    {
        $this->authorize('create', Authentication::class);

        return new AuthenticationResource(Authentication::create($request->validated()));
    }

    public function show(Authentication $authentication)
    {
        $this->authorize('view', $authentication);

        return new AuthenticationResource($authentication);
    }

    public function update(AuthenticationRequest $request, Vendor $vendor, Authentication $authentication)
    {
        $this->authorize('update', $authentication);

        $authentication->update($request->validated());

        return new AuthenticationResource($authentication);
    }

    public function destroy(Authentication $authentication)
    {
        $this->authorize('delete', $authentication);

        $authentication->delete();

        return response()->json();
    }
}
