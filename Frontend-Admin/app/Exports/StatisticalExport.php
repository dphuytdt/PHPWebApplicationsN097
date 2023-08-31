<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatisticalExport implements FromCollection, WithHeadings, WithCustomCsvSettings
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
        foreach ($this->data as $key => $value) {
            $this->data[$key]['id'] = $value['id'] ?? '';
            $this->data[$key]['user_id'] = $value['user_id'] ?? '';
            $this->data[$key]['book_id'] = $value['book_id'] ?? '';
            $this->data[$key]['total_price'] = $value['total_price'] ?? '';
            $this->data[$key]['payment_method'] = $value['payment_method'] ?? '';
            $this->data[$key]['created_at'] = $value['created_at'] ?? 'N/A';
            $this->data[$key]['updated_at'] = $value['updated_at'] ?? 'N/A';
            $this->data[$key]['deleted_at'] = $value['deleted_at'] ?? 'N/A';
        }
        return collect([$this->data]);
    }


    public function headings(): array
    {
        return [
            "ID",
            "User ID",
            "Book ID",
            "Total Price",
            "Payment Method",
            "Created At",
            "Updated At",
            "Deleted At",
        ];
    }
}
