<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{

    protected $table = 'slide_shows';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'image',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
