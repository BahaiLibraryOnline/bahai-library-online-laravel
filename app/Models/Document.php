<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

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
        'input_by',
        'input_date',
        'proof_by',
        'proof_date',
        'format_by',
        'format_date',
        'post_by',
        'post_date',
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
        'input_date' => 'date',
        'proof_date' => 'date',
        'format_date' => 'date',
        'post_date' => 'date',
    ];

    public function editions()
    {
        return $this->hasMany(Edition::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}
