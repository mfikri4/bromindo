<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKtp extends Model
{
    use HasFactory;
    protected $table = 'data_ktps';
    protected $primaryKey = 'id_ktp';
    protected $fillable = [
        'nik',
        'nama',
        'tempat',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'status',
        'pekerjaan',
        'kewarganegaraan',
        'berlaku',
        'foto'
    ];

    public static $rules = [
        'nik'           => 'required',
        'nama'          => 'required',
        'tempat'        => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'alamat'        => 'required',
        'agama'         => 'required',
        'status'        => 'required',
        'pekerjaan'     => 'required',
        'kewarganegaraan'=> 'required',
        'berlaku'       => 'required'
    ]; 
}
