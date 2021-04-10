<?php

namespace App\Http\Controllers\Api;

use App\Models\Edition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EditionResource;
use App\Http\Resources\EditionCollection;
use App\Http\Requests\EditionStoreRequest;
use App\Http\Requests\EditionUpdateRequest;

class EditionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Edition::class);

        $search = $request->get('search', '');

        $editions = Edition::search($search)
            ->latest()
            ->paginate();

        return new EditionCollection($editions);
    }

    /**
     * @param \App\Http\Requests\EditionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditionStoreRequest $request)
    {
        $this->authorize('create', Edition::class);

        $validated = $request->validated();

        $edition = Edition::create($validated);

        return new EditionResource($edition);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Edition $edition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Edition $edition)
    {
        $this->authorize('view', $edition);

        return new EditionResource($edition);
    }

    /**
     * @param \App\Http\Requests\EditionUpdateRequest $request
     * @param \App\Models\Edition $edition
     * @return \Illuminate\Http\Response
     */
    public function update(EditionUpdateRequest $request, Edition $edition)
    {
        $this->authorize('update', $edition);

        $validated = $request->validated();

        $edition->update($validated);

        return new EditionResource($edition);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Edition $edition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Edition $edition)
    {
        $this->authorize('delete', $edition);

        $edition->delete();

        return response()->noContent();
    }
}
