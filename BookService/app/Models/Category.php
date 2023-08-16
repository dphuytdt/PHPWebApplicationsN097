<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected  $table = 'tbl_category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'image_extension',
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //relationship
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'category_id', 'id');
    }


}
