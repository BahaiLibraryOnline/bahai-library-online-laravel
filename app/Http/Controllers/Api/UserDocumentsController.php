<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

class UserDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $documents = $user
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Document $document)
    {
        $this->authorize('update', $user);

        $user->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user, Document $document)
    {
        $this->authorize('update', $user);

        $user->documents()->detach($document);

        return response()->noContent();
    }
}
