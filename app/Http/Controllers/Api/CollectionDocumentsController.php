<?php
namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

#[OpenApi\PathItem]
class CollectionDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Collection $collection)
    {
        $this->authorize('view', $collection);

        $search = $request->get('search', '');

        $documents = $collection
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Collection $collection,
        Document $document
    ) {
        $this->authorize('update', $collection);

        $collection->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Collection $collection,
        Document $document
    ) {
        $this->authorize('update', $collection);

        $collection->documents()->detach($document);

        return response()->noContent();
    }
}
