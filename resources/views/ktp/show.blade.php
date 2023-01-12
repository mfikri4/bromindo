@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="py-2">Data KTP</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Status</th>
                            <th>Pekerjaan</th>
                            <th>Kewarganegaraan</th>
                            <th>Berlaku Sampai</th>
                            <th>Foto KTP</th>
                            </tr>
                        </thead>
                        <?php
                            $awal  = date_create($dt->tanggal_lahir);
                            $akhir = date_create(); // waktu sekarang
                            $diff  = date_diff( $awal, $akhir );
                        ?>
                        <tbody>
                            <tr>
                                <td>{{$dt->nik}}</td>
                                <td>{{$dt->nama}}</td>
                                <td>{{$dt->tempat}}, {{ date("j F Y", strtotime($dt->tanggal_lahir)); }}</td>
                                <td>{{ $diff->y }}</td>
                                <td>{{$dt->jenis_kelamin}}</td>
                                <td>{{$dt->alamat}}</td>
                                <td>{{$dt->agama}}</td>
                                <td>{{$dt->status}}</td>
                                <td>{{$dt->pekerjaan}}</td>
                                <td>{{$dt->kewarganegaraan}}</td>
                                <td>{{$dt->berlaku}}</td>
                                <td><img width="100px" src="{{ url($dt->foto) }}"></td>
                                
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
