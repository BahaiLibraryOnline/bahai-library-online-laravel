<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['label'];

    protected $searchableFields = ['*'];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}
