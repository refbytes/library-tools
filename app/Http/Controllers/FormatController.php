<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormatRequest;
use App\Http\Resources\FormatResource;
use App\Models\Subscriptions\Format;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormatController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Format::class);

        return FormatResource::collection(Format::all());
    }

    public function store(FormatRequest $request)
    {
        $this->authorize('create', Format::class);

        return new FormatResource(Format::create($request->validated()));
    }

    public function show(Format $format)
    {
        $this->authorize('view', $format);

        return new FormatResource($format);
    }

    public function update(FormatRequest $request, Format $format)
    {
        $this->authorize('update', $format);

        $format->update($request->validated());

        return new FormatResource($format);
    }

    public function destroy(Format $format)
    {
        $this->authorize('delete', $format);

        $format->delete();

        return response()->json();
    }
}