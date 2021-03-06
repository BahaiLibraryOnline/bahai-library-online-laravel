<?php
namespace App\Http\Controllers\Api;

use App\Models\Language;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

#[OpenApi\PathItem]
class LanguageDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Language $language)
    {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $documents = $language
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Language $language,
        Document $document
    ) {
        $this->authorize('update', $language);

        $language->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Language $language,
        Document $document
    ) {
        $this->authorize('update', $language);

        $language->documents()->detach($document);

        return response()->noContent();
    }
}
