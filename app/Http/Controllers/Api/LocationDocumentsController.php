<?php
namespace App\Http\Controllers\Api;

use App\Models\Location;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentCollection;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\SuccessfulResponse;

#[OpenApi\PathItem]
class LocationDocumentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['location-documents'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function index(Request $request, Location $location)
    {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $documents = $location
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['location-documents'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function store(
        Request $request,
        Location $location,
        Document $document
    ) {
        $this->authorize('update', $location);

        $location->documents()->syncWithoutDetaching([$document->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['location-documents'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function destroy(
        Request $request,
        Location $location,
        Document $document
    ) {
        $this->authorize('update', $location);

        $location->documents()->detach($document);

        return response()->noContent();
    }
}
