<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersSiswaExport implements fromQuery, WithHeadings
{
    use Exportable;

    public function siswaId(int $id)
    {
        $this->id = $id;

        return $this;
    }


    public function query()
    {
        return User::query()->where('role', $this->id);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Role',
            'Email',
            'nis',
            'kelas_id'
        ];
    }
}
