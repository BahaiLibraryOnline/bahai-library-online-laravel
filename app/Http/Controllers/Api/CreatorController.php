<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CreatorResource;
use App\Http\Resources\CreatorCollection;
use App\Http\Requests\CreatorStoreRequest;
use App\Http\Requests\CreatorUpdateRequest;

#[OpenApi\PathItem]
class CreatorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Creator::class);

        $search = $request->get('search', '');

        $creators = Creator::search($search)
            ->latest()
            ->paginate();

        return new CreatorCollection($creators);
    }

    /**
     * @param \App\Http\Requests\CreatorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatorStoreRequest $request)
    {
        $this->authorize('create', Creator::class);

        $validated = $request->validated();

        $creator = Creator::create($validated);

        return new CreatorResource($creator);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Creator $creator)
    {
        $this->authorize('view', $creator);

        return new CreatorResource($creator);
    }

    /**
     * @param \App\Http\Requests\CreatorUpdateRequest $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function update(CreatorUpdateRequest $request, Creator $creator)
    {
        $this->authorize('update', $creator);

        $validated = $request->validated();

        $creator->update($validated);

        return new CreatorResource($creator);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Creator $creator)
    {
        $this->authorize('delete', $creator);

        $creator->delete();

        return response()->noContent();
    }
}
