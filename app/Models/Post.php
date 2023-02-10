<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
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
