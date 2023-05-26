<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'wards';
    protected $fillable = [
        'name',
        'gso_id',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function province()
    {
        return $this->belongsToThrough(Province::class, District::class);
    }

    public function getWardByDistrictId($district_id)
    {
        return $this->where('district_id', $district_id)->get();
    }
}
