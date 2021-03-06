<?php
namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionCollection;

#[OpenApi\PathItem]
class DocumentCollectionsController extends Controller
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

        $collections = $document
            ->collections()
            ->search($search)
            ->latest()
            ->paginate();

        return new CollectionCollection($collections);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Document $document,
        Collection $collection
    ) {
        $this->authorize('update', $document);

        $document->collections()->syncWithoutDetaching([$collection->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Document $document,
        Collection $collection
    ) {
        $this->authorize('update', $document);

        $document->collections()->detach($collection);

        return response()->noContent();
    }
}
