<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'provinces';
    protected $fillable = [
        'name',
        'gso_id',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function wards()
    {
        return $this->hasManyThrough(Ward::class, District::class);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getAllNameById($province_id, $district_id)
    {
        $province = $this->where('id', $province_id)->first();
        $district = $province->districts()->where('id', $district_id)->first();
        return [
            'province_name' => $province->name,
            'district_name' => $district->name,
           
        ];
    }
}
