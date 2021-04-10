<?php
namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageCollection;

class DocumentLanguagesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Document $document)
    {
        $this->authorize('view', $document);

        $search = $request->get('search', '');

        $languages = $document
            ->languages()
            ->search($search)
            ->latest()
            ->paginate();

        return new LanguageCollection($languages);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Document $document,
        Language $language
    ) {
        $this->authorize('update', $document);

        $document->languages()->syncWithoutDetaching([$language->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Document $document,
        Language $language
    ) {
        $this->authorize('update', $document);

        $document->languages()->detach($language);

        return response()->noContent();
    }
}
