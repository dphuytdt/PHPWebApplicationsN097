<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBooks extends Model
{
    use HasFactory;

    protected  $table = 'user_books';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    protected $casts = [
        'book_id' => 'array',
    ];
}
