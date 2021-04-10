<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Creator extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'first_names',
        'last_names',
        'author',
        'editor',
        'translator',
        'compiler',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'author' => 'boolean',
        'editor' => 'boolean',
        'translator' => 'boolean',
        'compiler' => 'boolean',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}
