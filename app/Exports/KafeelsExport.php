<?php

namespace App\Exports;

use App\Models\Kafeel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KafeelsExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kafeel::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'fullname',
            'national_id',
            'phone_number',
            'national_id_photo',
            'user_id',
            'created_at',
            'updated_at'

        ];
    }
}
