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
        'author_id',
        'category_id',
        // 'publisher_id',
        'quantity',
        'price',
        'description',
        'image',
        'content',
        'is_free',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //relationship
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
