<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.creators.index', compact('creators', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Creator::class);

        return view('app.creators.create');
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

        return redirect()
            ->route('creators.edit', $creator)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Creator $creator)
    {
        $this->authorize('view', $creator);

        return view('app.creators.show', compact('creator'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Creator $creator)
    {
        $this->authorize('update', $creator);

        return view('app.creators.edit', compact('creator'));
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

        return redirect()
            ->route('creators.edit', $creator)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('creators.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
