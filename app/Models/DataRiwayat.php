<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRiwayat extends Model
{
    use HasFactory;
    protected $table = 'data_riwayats';
    protected $primaryKey = "id_riwayat";
    protected $fillable = [
        'user_id',
        'deskripsi',
        'aktivitas',        
        'status',
    ];

    public static $rules = [
        'user_id'       => 'required',
        'deskripsi'     => 'required',
        'aktivitas'     => 'required',
        'status'        => 'required',
    ]; 
}
