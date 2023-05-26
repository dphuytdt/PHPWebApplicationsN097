<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'tbl_author';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //relationship
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
    
}
