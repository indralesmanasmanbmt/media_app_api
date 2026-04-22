<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::get();
        return response() -> json($kategori);
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


        //validasi form
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
        ]);

        //cek jika ada error validasi form
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        //simpan data
        $kategori = Kategori::create($request->all()); 
        $kategori->fill($request->all());
        $simpan = $kategori->save();

        //cek jika data berhasil disimpan
        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
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
        //cari data berdasarkan id
        $kategori = Kategori::find($id);

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
        ]);

        //cek jika data tidak ditemukan
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'error' => 'Kategori tidak ditemukan'
            ], 422);
        }

        //update data
        $kategori->fill($request->all());
        $simpan = $kategori->save();

        //cek jika data berhasil diupdate
         if ($simpan) {
            return response()->json([
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'Gagal mengupdate data'
            ], 422);
        }



            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //cari data berdasarkan id
        $kategori = Kategori::find($id);

        //cek jika data tidak ditemukan
        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'error' => 'Kategori tidak ditemukan'
            ], 404);
        }

        //hapus data
        $hapus = $kategori->delete();

        //cek jika data berhasil dihapus
        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'Gagal menghapus data'
            ], 500);
        }
    }
}
