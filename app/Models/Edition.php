<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edition extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'subtitle',
        'title_parent',
        'volume',
        'page_range',
        'page_total',
        'publisher_name',
        'publisher_city',
        'date',
        'isbn',
        'document_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
