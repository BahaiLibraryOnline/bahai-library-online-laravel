<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EditionResource;
use App\Http\Resources\EditionCollection;

class DocumentEditionsController extends Controller
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

        $editions = $document
            ->editions()
            ->search($search)
            ->latest()
            ->paginate();

        return new EditionCollection($editions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Document $document)
    {
        $this->authorize('create', Edition::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'subtitle' => ['nullable', 'max:255', 'string'],
            'title_parent' => ['nullable', 'max:255', 'string'],
            'volume' => ['nullable', 'max:255', 'string'],
            'page_range' => ['nullable', 'max:255'],
            'page_total' => ['nullable', 'max:255'],
            'publisher_name' => ['nullable', 'max:255', 'string'],
            'publisher_city' => ['nullable', 'max:255', 'string'],
            'date' => ['nullable', 'date', 'date'],
            'isbn' => ['nullable', 'max:255', 'string'],
        ]);

        $edition = $document->editions()->create($validated);

        return new EditionResource($edition);
    }
}
