<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'image_extension',
        'is_active',
        'view',
        'like',
        'dislike',
        'comment',
        'share',
        'type',
        'is_hot',
        'tags',
        'creadted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'view' => 'integer',
        'like' => 'integer',
        'dislike' => 'integer',
        'comment' => 'integer',
        'share' => 'integer',
        'type' => 'integer',
        'is_hot' => 'integer',
        'creadted_by' => 'string',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags', 'news_id', 'tag_id');
    }
}
