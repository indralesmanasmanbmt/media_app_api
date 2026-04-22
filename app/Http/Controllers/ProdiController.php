<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::get();
        return response()->json($prodi);
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi form
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required',
            'singkatan' => 'required',
        ]);

        // cek jika ada error validasi form
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // menyimpan data
        $prodi = Prodi::create($request->all());
        $prodi->fill($request->all());
        $simpan = $prodi->save();

        // cek jika data berhasil disimpan
        if ($simpan) {
            return response() -> json ([
                'status' => 'success'
            ], 201);
        } else {
            return response() -> json ([
                'status' => 'error',
                'error' => 'Gagal menyimpan data'
            ], 422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // cari data berdasarkan id
        $prodi = Prodi::find($id);

        // validasi form
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required',
            'singkatan' => 'required',
        ]);
        
        // cari data berdasarkan id
        
        // cek jika ada error validasi form
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }


        // jika prodi di temukan
        if (!$prodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Prodi tidak ditemukan'
            ], 422);
        }

        // update data
        $prodi->fill($request->all());
        $simpan = $prodi->save();

        // cek jika data berhasil disimpan
        if ($simpan) {
            return response() -> json ([
                'status' => 'success'
            ], 201);
        } else {
            return response() -> json ([
                'status' => 'error',
                'error' => 'Gagal menyimpan data'
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // cari data berdasarkan id
    $prodi = Prodi::find($id);

    // jika tidak ditemukan
    if (!$prodi) {
        return response()->json([
            'status' => 'error',
            'message' => 'Prodi tidak ditemukan'
        ], 404);
    }

    // hapus data
    $hapus = $prodi->delete();

    if ($hapus) {
        return response()->json([
            'status' => 'success'
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menghapus data'
        ], 500);
    }
}
}
