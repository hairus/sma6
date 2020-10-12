<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersGuruExport implements fromQuery, WithHeadings
{
    use Exportable;

    public function guruId(int $id)
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
        ];
    }
}
