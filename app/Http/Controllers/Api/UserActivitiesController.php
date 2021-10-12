<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class UserActivitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $activities = $user
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'document_id' => ['required', 'exists:documents,id'],
            'activity_type' => [
                'required',
                'in:created,proofread,formatted,published,depublished',
            ],
            'comment' => ['required', 'max:255', 'string'],
        ]);

        $activity = $user->activities()->create($validated);

        return new ActivityResource($activity);
    }
}
