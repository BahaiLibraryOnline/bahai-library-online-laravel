<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Document;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.editions.index', compact('editions', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Edition::class);

        $documents = Document::pluck('slug', 'id');

        return view('app.editions.create', compact('documents'));
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

        return redirect()
            ->route('editions.edit', $edition)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Edition $edition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Edition $edition)
    {
        $this->authorize('view', $edition);

        return view('app.editions.show', compact('edition'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Edition $edition
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Edition $edition)
    {
        $this->authorize('update', $edition);

        $documents = Document::pluck('slug', 'id');

        return view('app.editions.edit', compact('edition', 'documents'));
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

        return redirect()
            ->route('editions.edit', $edition)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('editions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
