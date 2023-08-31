<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tbl_book';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'price',
        'description',
        'cover_image',
        'image_extension',
        'content_type',
        'content',
        'discount',
        'is_featured',
        'status',
        'rating',
        'is_vip_valid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }
}
