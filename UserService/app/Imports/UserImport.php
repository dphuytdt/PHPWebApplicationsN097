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

    private const COL_USER_FULLNAME = 'fullname';

    private const COL_USER_EMAIL = 'email';

    private const COL_USER_ROLE = 'role';

    private const COL_USER_DELETE = 'delete';

    private $users = [];

    public function model(array $row): ?User
    {
        $date = date('Y-m-d H:i:s');
        if($row['id'] != NULL) {
            $user = User::find($row['id']);
            if($user != NULL){
                return NULL;
            }else{
                $user = new User([
                    'id' => $row['id'],
                    'fullname' => $row[self::COL_USER_FULLNAME],
                    'email' => $row[self::COL_USER_EMAIL],
                    'role_id' => $row[self::COL_USER_ROLE],
                    'created_at' => $date,
                    'updated_at' => $date,
                    'deleted_at' => $row[self::COL_USER_DELETE]
                ]);

                return $user;            }
        }else{
            $user = new User([
                'fullname' => $row[self::COL_USER_FULLNAME],
                'email' => $row[self::COL_USER_EMAIL],
                'role' => $row[self::COL_USER_ROLE],
                'created_at' => $date,
                'updated_at' => $date,
                'deleted_at' => $row[self::COL_USER_DELETE]
            ]);

            return $user;
        }
    }

    public function rules(): array
    {
        return [
            self::COL_USER_FULLNAME => 'required',
            self::COL_USER_EMAIL => 'required|email|unique:users',
            self::COL_USER_ROLE => 'required|in:ROLE_USER,ROLE_ADMIN',
            self::COL_USER_DELETE => 'nullable|date'
        ];
    }

    public function getUsers()
    {
        return $this->users;
    }
}
