<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Http\Resources\VendorResource;
use App\Models\Subscriptions\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VendorController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Vendor::class);

        return VendorResource::collection(Vendor::all());
    }

    public function store(VendorRequest $request)
    {
        $this->authorize('create', Vendor::class);

        return new VendorResource(Vendor::create($request->validated()));
    }

    public function show(Vendor $vendor)
    {
        $this->authorize('view', $vendor);

        return new VendorResource($vendor);
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $this->authorize('update', $vendor);

        $vendor->update($request->validated());

        return new VendorResource($vendor);
    }

    public function destroy(Vendor $vendor)
    {
        $this->authorize('delete', $vendor);

        $vendor->delete();

        return response()->json();
    }
}
