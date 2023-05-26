<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'tbl_otp';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'otp',
        'user_id'
    ];
}
