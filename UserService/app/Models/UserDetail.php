<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_detail';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'wallet',
        'address',
        'phone',
        'gender',
        'birthday',
        'image_extension',
        'avatar',
    ];

    //relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
