@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Data KTP') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('ktp/edit/' . $data->id_ktp) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="nik" class="col-md-4 col-form-label text-md-end">{{ __('NIK') }}</label>
                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ $data->nik }}" readonly>
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}" required autocomplete="nama" autofocus>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tempat" class="col-md-4 col-form-label text-md-end">{{ __('Tempat') }}</label>
                            <div class="col-md-6">
                                <input id="tempat" type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ $data->tempat }}" required autocomplete="tempat">
                                @error('tempat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required autocomplete="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
                            <div class="col-md-6">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="Laki-laki" {{( 'Laki-laki' == $data->jenis_kelamin) ? 'selected' : ''}}>Laki-laki</option>        
                                    <option value="Perempuan" {{( 'Perempuan' == $data->jenis_kelamin) ? 'selected' : ''}}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $data->alamat }}" required autocomplete="alamat">
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="agama" class="col-md-4 col-form-label text-md-end">{{ __('Agama') }}</label>
                            <div class="col-md-6">
                                <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="Islam" {{( 'Islam' == $data->agama) ? 'selected' : ''}}>Islam</option>        
                                    <option value="Kristen" {{( 'Kristen' == $data->agama) ? 'selected' : ''}}>Kristen</option>  
                                    <option value="Katolik" {{( 'Katolik' == $data->agama) ? 'selected' : ''}}>Katolik</option>  
                                    <option value="Buddha" {{( 'Buddha' == $data->agama) ? 'selected' : ''}}>Buddha</option>  
                                    <option value="Hindu" {{( 'Hindu' == $data->agama) ? 'selected' : ''}}>Hindu</option>  
                                    <option value="Konghucu" {{( 'Konghucu' == $data->agama) ? 'selected' : ''}}>Konghucu</option>
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ $data->status }}" required autocomplete="status">
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pekerjaan" class="col-md-4 col-form-label text-md-end">{{ __('Pekerjaan') }}</label>
                            <div class="col-md-6">
                                <input id="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" value="{{ $data->pekerjaan }}" required autocomplete="pekerjaan">
                                @error('pekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kewarganegaraan" class="col-md-4 col-form-label text-md-end">{{ __('Kewarganegaraan') }}</label>
                            <div class="col-md-6">
                                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror">
                                    <option value="WNI" {{( 'WNI' == $data->kewarganegaraan) ? 'selected' : ''}}>WNI</option>        
                                    <option value="WNA" {{( 'WNA' == $data->kewarganegaraan) ? 'selected' : ''}}>WNA</option>
                                </select>
                                @error('kewarganegaraan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="berlaku" class="col-md-4 col-form-label text-md-end">{{ __('Berlaku') }}</label>
                            <div class="col-md-6">
                                <input id="berlaku" type="text" class="form-control @error('berlaku') is-invalid @enderror" name="berlaku" value="{{ $data->berlaku }}" required autocomplete="berlaku">
                                @error('berlaku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="foto" class="col-md-4 col-form-label text-md-end">{{ __('Foto KTP') }}</label>
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <img width="100px" src="{{ url($data->foto) }}">
                            </div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit Data') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
