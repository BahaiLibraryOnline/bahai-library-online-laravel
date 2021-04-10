<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['language', 'language_tag'];

    protected $searchableFields = ['*'];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}
