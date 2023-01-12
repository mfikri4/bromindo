<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKtp;
use App\Models\DataRiwayat;
use App\Exports\KTPExport;
use App\Imports\KTPImport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Excel;
use PDF;
use Auth;

class DataKtpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportCSV(){
       $file_name = 'DataKTP_'.date('H:i- d F Y').'.csv';

       if($file_name){
            DataRiwayat::create([
            'user_id'       => auth()->user()->id,
            'deskripsi'     => 'Berhasil melakukan export CSV data KTP !',
            'aktivitas'     => 'Export CSV Data KTP',
            'status'        => 'Berhasil',
            ]);  

            return Excel::download(new KTPExport, $file_name);
        }
    }

    public function importCSV(Request $request)
    {
        var_dump($request->file);
        Excel::import(new KTPImport, $request->file);

        return redirect('ktp')->with('success', 'Data KTP Berhasil di Impor Successfully');
    }

    public function printPDF()
    {
    	$data = DataKtp::all();
 
    	$pdf = PDF::loadview('ktp.pdf',['data'=>$data])->setPaper('a4', 'landscape');
        if($pdf){
            DataRiwayat::create([
            'user_id'       => auth()->user()->id,
            'deskripsi'     => 'Berhasil melakukan export PDF data KTP !',
            'aktivitas'     => 'Export PDF Data KTP',
            'status'        => 'Berhasil',
            ]);  

    	    return $pdf->download('DataKTP_'.date('H:i- d F Y').'.pdf');
        }
         // $pdf = PDF::loadview('ktp.pdf',['data'=>$data])->setPaper('a4')->setOrientation('landscape');
            // $pdf->setWarnings(false);
    	    // return $pdf->save('DataKTP_'.date('H:i- d F Y').'.pdf');
    }
    public function exportExcel(){
       $file_name = 'DataKTP_'.date('Y_m_d_H_i_s').'.xlsx';
       return Excel::download(new KTPExport, $file_name);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 100;
        $data = DataKtp::paginate(100);;
        return view('ktp.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ktp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fotoktp  = $request['foto'];
        $request['foto'] = "";
        if ($request->hasFile('foto')){
            $fotoktp = Str::random("10") . "-" . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move("file/ktp/",$fotoktp);
            $requests['foto']="file/ktp/" . $fotoktp;
        }

        $ktp = DataKtp::create([
            'nik'           => rand(),
            'nama'          => $request['nama'],
            'tempat'        => $request['tempat'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'alamat'        => $request['alamat'],
            'agama'         => $request['agama'],
            'status'        => $request['status'],
            'pekerjaan'     => $request['pekerjaan'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'berlaku'       => $request['berlaku'],
            'foto'          => "file/ktp/".$fotoktp,
        ]);

        if($ktp){
            DataRiwayat::create([
            'user_id'       => $request['user_id'],
            'deskripsi'     => 'Berhasil menambah data ktp A.N '. $request['nama']. '!',
            'aktivitas'     => 'Tambah Data KTP',
            'status'        => 'Berhasil',
            ]);  

            return redirect('ktp')->with('status', 'Berhasil menambah data!');
        }

        return redirect('ktp')->with('status', 'Gagal Menambah data!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dt = DataKtp::find($id);
        return view('ktp.show', compact('dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DataKtp::find($id);
        return view('ktp.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $d = DataKtp::find($id);
        if ($d == null){
            return redirect('ktp')->with('status','Data tidak ditemukan !');

        }
        $req = $request->all();

        if ($request->hasFile('foto')){
            if ($d->foto !== null){
                File::delete("$d->foto");
            }
            $fotoktp = Str::random("20") . "-" . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move("file/ktp/",$fotoktp);
            $req['foto']="file/ktp/".$fotoktp;
        }

        $data = DataKtp::find($id)->update($req);
        if ($data){
            DataRiwayat::create([
            'user_id'       => $request['user_id'],
            'deskripsi'     => 'Berhasil mengedit data ktp A.N '. $request['nama']. '!',
            'aktivitas'     => 'Edit Data KTP',
            'status'        => 'Berhasil',
            ]);  
            return redirect('ktp')->with('status', 'Data berhasil diedit !');
        }
        return redirect('ktp')->with('status','Gagal edit data !');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataKtp::find($id);
        if ($data == null) {
            return redirect('ktp')->with('status', 'Data tidak ditemukan !');
        }

        $delete = $data->delete();
        if ($delete) {

            DataRiwayat::create([
            'user_id'       => $request['user_id'],
            'deskripsi'     => 'Berhasil Menghapus data ktp A.N '. $request['nama']. '!',
            'aktivitas'     => 'Hapus Data KTP',
            'status'        => 'Berhasil',
            ]);  
            return redirect('ktp')->with('status', 'Berhasil hapus data !');
        }
        return redirect('ktp')->with('status', 'Gagal hapus data !');
        
    }
}
