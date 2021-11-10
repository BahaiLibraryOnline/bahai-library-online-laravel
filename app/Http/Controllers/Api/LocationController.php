<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Location::class);

        $search = $request->get('search', '');

        $locations = Location::search($search)
            ->latest()
            ->paginate();

        return new LocationCollection($locations);
    }

    /**
     * @param \App\Http\Requests\LocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationStoreRequest $request)
    {
        $this->authorize('create', Location::class);

        $validated = $request->validated();

        $location = Location::create($validated);

        return new LocationResource($location);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Location $location)
    {
        $this->authorize('view', $location);

        return new LocationResource($location);
    }

    /**
     * @param \App\Http\Requests\LocationUpdateRequest $request
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $this->authorize('update', $location);

        $validated = $request->validated();

        $location->update($validated);

        return new LocationResource($location);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Location $location)
    {
        $this->authorize('delete', $location);

        $location->delete();

        return response()->noContent();
    }
}
