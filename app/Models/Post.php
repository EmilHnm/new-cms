<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'content',
        'thumb',
        'active',
        'author',
        'approvor',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbAttribute()
    {
        return Storage::cloud()->temporaryUrl(
            'hoanm_img/' . $this->attributes['thumb'],
            Carbon::now()->addMinutes(5)
        );
    }

    public function checkThumb()
    {
        if (empty($this->attributes['thumb'])) {
            return false;
        }
        return true;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function approvor()
    {
        return $this->belongsTo(User::class, 'approvor_id', 'id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }
}
