<?php

namespace App\Exports;

use App\Models\DataKtp;
use Maatwebsite\Excel\Concerns\FromCollection;

class KTPExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $records = DataKtp::select('*')->get();

        $result = array();
        foreach($records as $record){

            $awal  = date_create($record->tanggal_lahir);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff( $awal, $akhir );

            
           $result[] = array(
              'nik'=>$record->nik,
              'nama' => $record->nama,
              'tempat' => $record->tempat,
              'tanggal_lahir' => $record->tanggal_lahir,
              'umur' => $diff->y, //variabel umur merupakan variabel tambahan
              'jenis_kelamin' =>  $record->jenis_kelamin,
              'alamat' =>  $record->alamat,
              'agama' =>  $record->agama,
              'status' =>  $record->status,
              'pekerjaan' =>  $record->pekerjaan,
              'kewarganegaraan' =>  $record->kewarganegaraan,
              'berlaku' =>  $record->berlaku,
              'foto' =>  $record->foto,
           );
        }

        return collect($result);

        // return DataKtp::all();
    }
    
    public function headings(): array
    {
        return [
          '#',
          'NIK',
          'Nama',
          'Tempat',
          'Tanggal Lahir',
          'Jenis Kelamin',
          'Alamat',
          'Agama',
          'Status',
          'Pekerjaan',
          'Kewarganegaraan',
          'Berlaku Sampai',
          'URL Foto'
        ];
    }
}
