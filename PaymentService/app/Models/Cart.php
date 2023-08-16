<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected  $table = 'carts';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'cover_image',
        'price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
