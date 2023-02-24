<?php

namespace App\Exports;

use App\Models\Installment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstallmentsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Installment::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'installment_status',
            'receipt_photo',
            'value',
            'date',
            'created_at',
            'updated_at',
            'installment_request_id'
        ];
    }
}
