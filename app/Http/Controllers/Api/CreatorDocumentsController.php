<?php
namespace App\Http\Controllers\Api;

use App\Models\Creator;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

class CreatorDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Creator $creator)
    {
        $this->authorize('view', $creator);

        $search = $request->get('search', '');

        $documents = $creator
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Creator $creator,
        Document $document
    ) {
        $this->authorize('update', $creator);

        $creator->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creator $creator
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Creator $creator,
        Document $document
    ) {
        $this->authorize('update', $creator);

        $creator->documents()->detach($document);

        return response()->noContent();
    }
}
