<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    protected array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => ''
        ];
    }


    public function collection(): \Illuminate\Support\Collection
    {
        if($this->data == null){
            return collect([]);
        }

        foreach ($this->data as $key => $value) {
            $this->data[$key]['id']  = $value['id'] ?? '';
            $this->data[$key]['fullname'] = $value['fullname'] ?? '';
            $this->data[$key]['email'] = $value['email'] ?? '';
            $this->data[$key]['email_verified_at'] = $value['email_verified_at'] ?? '';
            $this->data[$key]['role'] = $value['role'] ?? '';
            $this->data[$key]['is_vip'] = $value['is_vip'] == 1 ? 'Yes' : 'No';
            $this->data[$key]['valid_vip'] = $value['valid_vip'] ?? '';
            $this->data[$key]['date_start_vip'] = $value['date_start_vip'] ?? '';
            $this->data[$key]['date_end_vip'] = $value['date_end_vip'] ?? '';
            $this->data[$key]['is_active'] = $value['is_active'] == 1 ? 'Active' : 'Inactive';
            $this->data[$key]['created_at'] = $value['created_at'] ?? '';
            $this->data[$key]['updated_at'] = $value['updated_at'] ?? '';
            $this->data[$key]['deleted_at'] = $value['deleted_at'] ?? '';
            $this->data[$key]['phone'] = $value['user_detail']['phone'] ?? '';
            $this->data[$key]['address'] = $value['user_detail']['address'] ?? '';
            $this->data[$key]['gender'] = $value['user_detail']['gender'] == 1 ? 'Male' : "Female";
        }

        foreach ($this->data as $key => $value) {
            unset($this->data[$key]['user_detail']);
        }

        return collect([$this->data]);
    }


    public function headings(): array
    {
        return [
            "ID",
            "FullName",
            "Email",
            "Email Verified At",
            "Role",
            "Vip Member",
            "Valid Vip",
            "Date Start Vip",
            "Date End Vip",
            "Status",
            "Created At",
            "Updated At",
            "Deleted At",
            "Phone",
            "Address",
            "Gender",
        ];
    }
}
