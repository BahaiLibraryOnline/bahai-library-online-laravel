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
        'is_author',
        'is_editor',
        'is_translator',
        'is_compiler',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_author' => 'boolean',
        'is_editor' => 'boolean',
        'is_translator' => 'boolean',
        'is_compiler' => 'boolean',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}
