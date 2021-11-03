<?php
namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

class TagDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tag $tag)
    {
        $this->authorize('view', $tag);

        $search = $request->get('search', '');

        $documents = $tag
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Document $document)
    {
        $this->authorize('update', $tag);

        $tag->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $tag, Document $document)
    {
        $this->authorize('update', $tag);

        $tag->documents()->detach($document);

        return response()->noContent();
    }
}
