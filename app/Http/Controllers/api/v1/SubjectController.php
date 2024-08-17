<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subscriptions\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Subject::class);

        return SubjectResource::collection(
            Subject::query()
                ->get()
        );
    }

    public function store(SubjectRequest $request)
    {
        $this->authorize('create', Subject::class);

        return new SubjectResource(Subject::create($request->validated()));
    }

    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);

        $subject
            ->load([
                'subscriptions',
            ]);

        return new SubjectResource($subject);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);

        $subject->delete();

        return response()->json();
    }
}
