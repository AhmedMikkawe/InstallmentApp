<?php

namespace App\Exports;

use App\Models\InstallmentRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstallmentRequestsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InstallmentRequest::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'required_device',
            'request_status',
            'request_type',
            'installment_value',
            'installment_count',
            'total',
            'created_at',
            'updated_at',
            'user_id'
        ];
    }
}
