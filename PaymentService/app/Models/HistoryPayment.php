<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPayment extends Model
{
    use HasFactory;

    protected $table = 'history_payments';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'quantity',
        'cover_image',
        'image_extension',
        'price',
        'status',
        'created_at',
        'updated_at'
    ];

}
