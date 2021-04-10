<?php

namespace App\Http\Controllers\Api;

use App\Models\Search;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\SearchStoreRequest;
use App\Http\Requests\SearchUpdateRequest;

class SearchController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Search::class);

        $search = $request->get('search', '');

        $search = Search::search($search)
            ->latest()
            ->paginate();

        return new SearchCollection($search);
    }

    /**
     * @param \App\Http\Requests\SearchStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SearchStoreRequest $request)
    {
        $this->authorize('create', Search::class);

        $validated = $request->validated();

        $search = Search::create($validated);

        return new SearchResource($search);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Search $search)
    {
        $this->authorize('view', $search);

        return new SearchResource($search);
    }

    /**
     * @param \App\Http\Requests\SearchUpdateRequest $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function update(SearchUpdateRequest $request, Search $search)
    {
        $this->authorize('update', $search);

        $validated = $request->validated();

        $search->update($validated);

        return new SearchResource($search);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Search $search)
    {
        $this->authorize('delete', $search);

        $search->delete();

        return response()->noContent();
    }
}
