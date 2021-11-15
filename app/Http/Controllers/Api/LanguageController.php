<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\LanguageCollection;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\SuccessfulResponse;

#[OpenApi\PathItem]
class LanguageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['language'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function index(Request $request)
    {
        $this->authorize('view-any', Language::class);

        $search = $request->get('search', '');

        $languages = Language::search($search)
            ->latest()
            ->paginate();

        return new LanguageCollection($languages);
    }

    /**
     * @param \App\Http\Requests\LanguageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['language'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function store(LanguageStoreRequest $request)
    {
        $this->authorize('create', Language::class);

        $validated = $request->validated();

        $language = Language::create($validated);

        return new LanguageResource($language);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['language'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function show(Request $request, Language $language)
    {
        $this->authorize('view', $language);

        return new LanguageResource($language);
    }

    /**
     * @param \App\Http\Requests\LanguageUpdateRequest $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['language'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function update(LanguageUpdateRequest $request, Language $language)
    {
        $this->authorize('update', $language);

        $validated = $request->validated();

        $language->update($validated);

        return new LanguageResource($language);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['language'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function destroy(Request $request, Language $language)
    {
        $this->authorize('delete', $language);

        $language->delete();

        return response()->noContent();
    }
}
