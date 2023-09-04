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
        'rate',
        'user_id',
        'target_id',
        'comment_parent_id',
        'status',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
