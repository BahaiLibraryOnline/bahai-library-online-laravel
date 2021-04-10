<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;
use App\Http\Requests\SearchStoreRequest;
use App\Http\Requests\SearchUpdateRequest;

#[OpenApi\PathItem]
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
            ->paginate(5);

        return view('app.search.index', compact('search', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Search::class);

        return view('app.search.create');
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

        return redirect()
            ->route('search.edit', $search)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Search $search)
    {
        $this->authorize('view', $search);

        return view('app.search.show', compact('search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Search $search)
    {
        $this->authorize('update', $search);

        return view('app.search.edit', compact('search'));
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

        return redirect()
            ->route('search.edit', $search)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('search.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
