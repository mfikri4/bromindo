@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="py-2">Data KTP</h4>

                    <div class="card-header-action">
                    @if(auth()->user()->level == 1)
                        <a class="btn btn-success" href="{{ ('ktp/create') }}">Tambah Data</a>
                        <a class="btn btn-success" href="{{ url('ktp/exp-excel') }}">Excel</a>
                   
                        <a class="btn btn-info" href="{{ url('ktp/exp-csv') }}">CSV</a>
                        <a class="btn btn-info" href="{{ url('ktp/print-pdf') }}">PDF</a>
                        
                        <form class="py-2" action="{{ url('ktp/import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-6 text-left">
                                    <input type="file" name="file" class="form-control">
                                    <button type="submit" class="btn btn-success">Import CSV</button>   
                                </div>
                                
                            </div>                

                        </form> 
                    @elseif (auth()->user()->level == 2)

                        <a class="btn btn-info" href="{{ url('ktp2/exp-csv2') }}">CSV</a>
                        <a class="btn btn-info" href="{{ url('ktp2/print-pdf2') }}">PDF</a>
                    @endif   
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto KTP</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        ?>
                        @foreach ($data as $dt)
                        <?php
                            $awal  = date_create($dt->tanggal_lahir);
                            $akhir = date_create(); // waktu sekarang
                            $diff  = date_diff( $awal, $akhir );
                        ?>
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$dt->nik}}</td>
                                <td>{{$dt->nama}}</td>
                                <td>{{$dt->tempat}}, {{ date("j F Y", strtotime($dt->tanggal_lahir)); }}</td>
                                <td>{{ $diff->y }}</td>
                                <td>{{$dt->jenis_kelamin}}</td>
                                <td><img width="100px" src="{{ url($dt->foto) }}"></td>
                                <td>
                                    <a href="{{ url('ktp/show/'.$dt->id_ktp) }}" class="btn btn-info mb-2">  
                                        <i class="fa fa-edit"></i>
                                        Lihat 
                                    </a>
                                @if(auth()->user()->level == 1)
                                    <a href="{{ url('ktp/edit/'.$dt->id_ktp) }}" class="btn btn-primary mb-2">  
                                        <i class="fa fa-edit"></i>
                                        Edit 
                                    </a>
                                    <a href="{{ url('ktp/delete/'.$dt->id_ktp) }}" class="btn btn-danger mb-2">  
                                        <i class="fa fa-times"></i>
                                        Hapus
                                    </a>    
                                @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                        </table>
                      <div class="d-flex">{!! $data->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
