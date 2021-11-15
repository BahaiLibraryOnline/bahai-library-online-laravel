<?php

namespace App\Http\Controllers\Api;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionResource;
use App\Http\Resources\CollectionCollection;
use App\Http\Requests\CollectionStoreRequest;
use App\Http\Requests\CollectionUpdateRequest;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\SuccessfulResponse;

#[OpenApi\PathItem]
class CollectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['collection'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function index(Request $request)
    {
        $this->authorize('view-any', Collection::class);

        $search = $request->get('search', '');

        $collections = Collection::search($search)
            ->latest()
            ->paginate();

        return new CollectionCollection($collections);
    }

    /**
     * @param \App\Http\Requests\CollectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['collection'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function store(CollectionStoreRequest $request)
    {
        $this->authorize('create', Collection::class);

        $validated = $request->validated();

        $collection = Collection::create($validated);

        return new CollectionResource($collection);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['collection'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function show(Request $request, Collection $collection)
    {
        $this->authorize('view', $collection);

        return new CollectionResource($collection);
    }

    /**
     * @param \App\Http\Requests\CollectionUpdateRequest $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['collection'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function update(
        CollectionUpdateRequest $request,
        Collection $collection
    ) {
        $this->authorize('update', $collection);

        $validated = $request->validated();

        $collection->update($validated);

        return new CollectionResource($collection);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['collection'])]
    #[OpenApi\Response(factory: SuccessfulResponse::class)]
    public function destroy(Request $request, Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        return response()->noContent();
    }
}
