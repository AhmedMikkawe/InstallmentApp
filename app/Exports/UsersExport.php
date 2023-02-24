<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'fullname',
            'username',
            'email',
            'email_verified_at',
            'nationalId',
            'nationalId_photo',
            'phone-number',
            'created_at',
            'updated_at'

        ];
    }

}
