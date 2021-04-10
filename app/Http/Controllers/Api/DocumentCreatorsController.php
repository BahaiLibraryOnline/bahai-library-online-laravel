<?php
namespace App\Http\Controllers\Api;

use App\Models\Creator;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CreatorCollection;

#[OpenApi\PathItem]
class DocumentCreatorsController extends Controller
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

        $creators = $document
            ->creators()
            ->search($search)
            ->latest()
            ->paginate();

        return new CreatorCollection($creators);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Document $document,
        Creator $creator
    ) {
        $this->authorize('update', $document);

        $document->creators()->syncWithoutDetaching([$creator->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Document $document,
        Creator $creator
    ) {
        $this->authorize('update', $document);

        $document->creators()->detach($creator);

        return response()->noContent();
    }
}
