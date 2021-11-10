<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'is_pdf',
        'is_audio',
        'is_image',
        'is_video',
        'is_html',
        'file_url',
        'blurb',
        'content_html',
        'content_size',
        'edit_quality',
        'formatting_quality',
        'publication_permission',
        'notes',
        'input_type',
        'publication_approval',
        'views',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_pdf' => 'boolean',
        'is_audio' => 'boolean',
        'is_image' => 'boolean',
        'is_video' => 'boolean',
        'is_html' => 'boolean',
    ];

    public function editions()
    {
        return $this->hasMany(Edition::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }
}
