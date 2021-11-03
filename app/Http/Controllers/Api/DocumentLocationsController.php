<?php
namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationCollection;

class DocumentLocationsController extends Controller
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

        $locations = $document
            ->locations()
            ->search($search)
            ->latest()
            ->paginate();

        return new LocationCollection($locations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Document $document,
        Location $location
    ) {
        $this->authorize('update', $document);

        $document->locations()->syncWithoutDetaching([$location->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Document $document,
        Location $location
    ) {
        $this->authorize('update', $document);

        $document->locations()->detach($location);

        return response()->noContent();
    }
}
