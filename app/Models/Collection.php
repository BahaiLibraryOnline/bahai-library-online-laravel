<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['slug', 'name', 'shortname'];

    protected $searchableFields = ['*'];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}
