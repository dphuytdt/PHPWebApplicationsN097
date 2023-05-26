<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'gso_id',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function getDistrictByProvinceId($province_id)
    {
        return $this->where('province_id', $province_id)->get();
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
    
}
