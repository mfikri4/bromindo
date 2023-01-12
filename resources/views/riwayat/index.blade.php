@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="py-2">Riwayat Aktivitas</h4>
                    <!-- 
                    <div class="card-header-action">
                    @if(auth()->user()->level == 1)
                        <a class="btn btn-success" href="{{ ('ktp/create') }}">Tambah Data</a>
                        <a class="btn btn-success" href="{{ route('ktp.exportexcel') }}">Excel</a>
                    @endif
                        <a class="btn btn-info" href="{{ route('ktp.exportcsv') }}">CSV</a>
                        <a class="btn btn-info" href="{{ url('ktp/print-pdf') }}">PDF</a>
                    </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aktivitas</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        @foreach ($data as $dt)
                        <tbody>
                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    @if ($dt->user_id == 99)
                                        REST API
                                    @else
                                        {{$dt->name}}
                                    @endif
                                    </td>
                                <td>{{$dt->deskripsi}}</td>
                                <td>{{$dt->aktivitas}}</td>
                                <td>{{$dt->status}}</td>
                                
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
