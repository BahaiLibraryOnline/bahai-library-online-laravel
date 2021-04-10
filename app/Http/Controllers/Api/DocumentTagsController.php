<?php
namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;

class DocumentTagsController extends Controller
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

        $tags = $document
            ->tags()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagCollection($tags);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Document $document, Tag $tag)
    {
        $this->authorize('update', $document);

        $document->tags()->syncWithoutDetaching([$tag->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Document $document, Tag $tag)
    {
        $this->authorize('update', $document);

        $document->tags()->detach($tag);

        return response()->noContent();
    }
}
