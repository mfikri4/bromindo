<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\DataKtp;
use App\Models\DataRiwayat;
use App\Http\Resources\DataKTPResource;


class KTPController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = DataKtp::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data KTP',
            'data'    => $data  
        ], 200);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find JenisDiklat by ID
        $data = DataKtp::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data KTP',
            'data'    => $data 
        ], 200);
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
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
            'berlaku'       => 'required',
            'foto'       => 'required'
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $data = DataKtp::create([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'tempat'        => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'agama'         => $request->agama,
            'status'        => $request->status,
            'pekerjaan'     => $request->pekerjaan,
            'kewarganegaraan'=> $request->kewarganegaraan,
            'berlaku'       => $request->berlaku,
            'foto'       => $request->foto
        ]);

        //success save to database
        if($data) {


            DataRiwayat::create([
            'user_id'       => 99,
            'deskripsi'     => 'Berhasil menambah data ktp A.N '. $request->nama. '!',
            'aktivitas'     => 'API | Tambah Data KTP',
            'status'        => 'Berhasil',
            ]);  

            return response()->json([
                'success' => true,
                'message' => 'Data Created',
                'data'    => $data  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Data Failed to Save',
        ], 409);

    }

    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $data
     * @return void
     */
    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
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
            'berlaku'       => 'required',
            'foto'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $data = DataKtp::findOrFail($id);

        if($data) {

            $data->update([
                'nik'           => $request->nik,
                'nama'          => $request->nama,
                'tempat'        => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'agama'         => $request->agama,
                'status'        => $request->status,
                'pekerjaan'     => $request->pekerjaan,
                'kewarganegaraan'=> $request->kewarganegaraan,
                'berlaku'       => $request->berlaku,
                'foto'       => $request->foto
            ]);

            DataRiwayat::create([
            'user_id'       => 99,
            'deskripsi'     => 'Berhasil mengedit data ktp A.N '. $request->nama. '!',
            'aktivitas'     => 'API | Edit Data KTP',
            'status'        => 'Berhasil',
            ]);  
            return response()->json([
                'success' => true,
                'message' => 'Data Updated',
                'data'    => $data  
            ], 200);

        }

        //data not found
        return response()->json([
            'success' => false,
            'message' => 'Data Not Found',
        ], 404);
    }


    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $data = DataKtp::findOrfail($id);

        if($data) {

            DataRiwayat::create([
            'user_id'       => 99,
            'deskripsi'     => 'Berhasil Menghapus data ktp!',
            'aktivitas'     => 'API | Hapus Data KTP',
            'status'        => 'Berhasil',
            ]);  

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data KTP Deleted',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data KTP Not Found',
        ], 404);
    }

}
