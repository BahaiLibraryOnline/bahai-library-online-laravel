<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\CollectionStoreRequest;
use App\Http\Requests\CollectionUpdateRequest;

#[OpenApi\PathItem]
class CollectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Collection::class);

        $search = $request->get('search', '');

        $collections = Collection::search($search)
            ->latest()
            ->paginate(5);

        return view('app.collections.index', compact('collections', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Collection::class);

        return view('app.collections.create');
    }

    /**
     * @param \App\Http\Requests\CollectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionStoreRequest $request)
    {
        $this->authorize('create', Collection::class);

        $validated = $request->validated();

        $collection = Collection::create($validated);

        return redirect()
            ->route('collections.edit', $collection)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Collection $collection)
    {
        $this->authorize('view', $collection);

        return view('app.collections.show', compact('collection'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        return view('app.collections.edit', compact('collection'));
    }

    /**
     * @param \App\Http\Requests\CollectionUpdateRequest $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function update(
        CollectionUpdateRequest $request,
        Collection $collection
    ) {
        $this->authorize('update', $collection);

        $validated = $request->validated();

        $collection->update($validated);

        return redirect()
            ->route('collections.edit', $collection)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        return redirect()
            ->route('collections.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
