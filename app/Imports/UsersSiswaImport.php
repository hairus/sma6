<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersSiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'role'     => $row['role'],
            'email'    => $row['email'],
            'nis'      => $row['nis'],
            'kelas_id' => $row['kelas_id'],
            'password' => Hash::make('password'),
        ]);
    }
}
