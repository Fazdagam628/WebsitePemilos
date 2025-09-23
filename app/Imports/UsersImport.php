<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'nis'      => $row['nis'],       // sesuai nama kolom di Excel
            'name'     => $row['name'],
            'password' => bcrypt($row['password'])
        ]);
    }
}
