<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\SuccessfulResponse;

#[OpenApi\PathItem]
class DocumentActivitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['document-activities'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function index(Request $request, Document $document)
    {
        $this->authorize('view', $document);

        $search = $request->get('search', '');

        $activities = $document
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['document-activities'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function store(Request $request, Document $document)
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'activity_type' => [
                'required',
                'in:created,proofread,formatted,published,depublished',
            ],
            'comment' => ['required', 'max:255', 'string'],
        ]);

        $activity = $document->activities()->create($validated);

        return new ActivityResource($activity);
    }
}
