<?php

namespace App\Imports;

use App\Models\DataKtp;
use Maatwebsite\Excel\Concerns\ToModel;

class KTPImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKtp([
            'nik'           => $row[0],
            'nama'          => $row[1],
            'tempat'        => $row[2],
            'tanggal_lahir' => $row[3],
            'jenis_kelamin' => $row[4],
            'alamat'        => $row[5],
            'agama'         => $row[6],
            'status'        => $row[7],
            'pekerjaan'     => $row[8],
            'kewarganegaraan'=> $row[9],
            'berlaku'       => $row[10],
            'foto'          => $row[11]
        ]);
    }
}
