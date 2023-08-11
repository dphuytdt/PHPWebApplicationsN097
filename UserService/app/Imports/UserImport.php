<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
class UserImport implements WithCalculatedFormulas, WithValidation, ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row): \Illuminate\Database\Eloquent\Model|User|null
    {
        $date = date('Y-m-d H:i:s');
        if($row['id'] != NULL) {
            $user = User::find($row['id']);
            if($user != NULL){
                $user->update([
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'division_id' => $row['division'],
                    'role_id' => $row['role'],
                    'is_active' => $row['is_active'],
                    'is_vip' => $row['is_vip'],
                    'created_at' => $date,
                    'updated_at' => $date,
                    'deleted_at' => $row['delete']
                ]);
            }else{
                return new User([
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'division_id' => $row['division'],
                    'role_id' => $row['role'],
                    'is_active' => $row['is_active'],
                    'is_vip' => $row['is_vip'],
                    'created_at' => $date,
                    'updated_at' => $date,
                    'deleted_at' => $row['delete']
                ]);
            }
        }else{
            return new User([
                'fullname' => $row['fullname'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'division_id' => $row['division'],
                'role_id' => $row['role'],
                'is_active' => $row['is_active'],
                'is_vip' => $row['is_vip'],
                'created_at' => $date,
                'updated_at' => $date,
                'deleted_at' => $row['delete']
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'division' => 'required|integer',
            'role' => 'required|integer',
            'is_active' => 'required|integer',
            'is_vip' => 'required|integer'
        ];
    }
    public function customValidationAttributes(): array
    {
        return [
            'id' => 'id',
            'fullname' => 'fullname',
            'email' => 'email',
            'phone' => 'phone',
            'division' => 'division',
            'role' => 'role',
            'is_active' => 'is_active',
            'is_vip' => 'is_vip'
        ];
    }

}
