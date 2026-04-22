<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use App\Models\Mahasiswa;
use App\Models\Kategori;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::get();
        return response()->json($media);
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
        // VALIDASI INPUT
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // SIMPAN DATA
        $media = Media::create($request->all());


        $media->fill($request->all());
        $simpan = $media->save();

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
        // VALIDASI INPUT
        $media = Media::find($id);
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'error' => 'Media tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // UPDATE DATA
        $media->fill($request->all());
        $simpan = $media->save();
        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
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
        // HAPUS DATA
        $media = Media::find($id);
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'error' => 'Media tidak ditemukan'
            ], 404);
            }

        $hapus = $media->delete();
        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'Gagal menghapus data'
            ], 422);
        }
    }
}
