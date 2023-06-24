<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected  $table = 'comments';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'comment_name',
        'content',
        'image',
        'user_id',
        'book_id',
        'comment_parent_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function commentParent()
    {
        return $this->belongsTo(Comment::class, 'comment_parent_id', 'id');
    }
}
