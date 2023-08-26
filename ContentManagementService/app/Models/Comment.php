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
        'news_id',
        'comment_parent_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
