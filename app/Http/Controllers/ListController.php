<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Resources\ListResource;
use App\Models\Subscriptions\List;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', list::class);

        return ListResource::collection(list::all());
        }

    public function store(ListRequest $request)
    {
        $this->authorize('create', list::class);

        return new ListResource(list::create($request->validated()));
        }

    public function show(list $list)
    {
        $this->authorize('view', $list);

        return new ListResource($list);
    }

    public function update(ListRequest $request, list $list)
    {
        $this->authorize('update', $list);

        $list->update($request->validated());

        return new ListResource($list);
    }

    public function destroy(list $list)
    {
        $this->authorize('delete', $list);

        $list->delete();

        return response()->json();
    }
}
