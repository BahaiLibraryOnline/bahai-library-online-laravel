<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;

#[OpenApi\PathItem]
class LanguageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Language::class);

        $search = $request->get('search', '');

        $languages = Language::search($search)
            ->latest()
            ->paginate(5);

        return view('app.languages.index', compact('languages', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Language::class);

        return view('app.languages.create');
    }

    /**
     * @param \App\Http\Requests\LanguageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageStoreRequest $request)
    {
        $this->authorize('create', Language::class);

        $validated = $request->validated();

        $language = Language::create($validated);

        return redirect()
            ->route('languages.edit', $language)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Language $language)
    {
        $this->authorize('view', $language);

        return view('app.languages.show', compact('language'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Language $language)
    {
        $this->authorize('update', $language);

        return view('app.languages.edit', compact('language'));
    }

    /**
     * @param \App\Http\Requests\LanguageUpdateRequest $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageUpdateRequest $request, Language $language)
    {
        $this->authorize('update', $language);

        $validated = $request->validated();

        $language->update($validated);

        return redirect()
            ->route('languages.edit', $language)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Language $language)
    {
        $this->authorize('delete', $language);

        $language->delete();

        return redirect()
            ->route('languages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
