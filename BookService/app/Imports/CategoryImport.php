<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoryImport implements WithCalculatedFormulas, WithValidation, ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private const COL_NAME = 'name';

    private const COL_STATUS = 'status';

    private const COL_DESCRIPTION = 'description';

    private $categories = [];

    public function model(array $row): ?Category
    {
        $date = date('Y-m-d H:i:s');

        $row[self::COL_STATUS] = strtolower($row[self::COL_STATUS]);

        if($row[self::COL_STATUS] == 'active') {
            $row[self::COL_STATUS] = 1;
        }

        if($row[self::COL_STATUS] == 'inactive') {
            $row[self::COL_STATUS] = 0;
        }

        if($row['id'] != NULL) {
            $category = Category::find($row['id']);
            if($category != NULL){
                return NULL;
            }else{
                $category = new Category([
                    'id' => $row['id'],
                    'name' => $row[self::COL_NAME],
                    'status' => $row[self::COL_STATUS],
                    'description' => $row[self::COL_DESCRIPTION],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                return $category;
            }
        }else{
            $category = new Category([
                'name' => $row[self::COL_NAME],
                'status' => $row[self::COL_STATUS],
                'description' => $row[self::COL_DESCRIPTION],
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            return $category;
        }
    }

    public function rules(): array
    {
        return [
            self::COL_NAME => 'required',
            self::COL_STATUS => 'required|in:0,1,active,inactive',
            self::COL_DESCRIPTION => 'required',
        ];
    }
}
