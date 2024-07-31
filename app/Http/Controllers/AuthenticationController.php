<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Resources\AuthenticationResource;
use App\Models\Subscriptions\Authentication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthenticationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Authentication::class);

        return AuthenticationResource::collection(Authentication::all());
    }

    public function store(AuthenticationRequest $request)
    {
        $this->authorize('create', Authentication::class);

        return new AuthenticationResource(Authentication::create($request->validated()));
    }

    public function show(Authentication $authentication)
    {
        $this->authorize('view', $authentication);

        return new AuthenticationResource($authentication);
    }

    public function update(AuthenticationRequest $request, Authentication $authentication)
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
