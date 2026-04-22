<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        // tampilkan dengan relasi prodi
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return response()->json($mahasiswa);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    

        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'prodi_id' => 'required|exists:prodi,prodi_id',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()
        ], 422);
    }

    $mahasiswa = Mahasiswa::create($request->all());

    return response()->json([
        'status' => 'success',
        'data' => $mahasiswa
    ], 201);
}

    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'error' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'prodi_id' => 'required|exists:prodi,prodi_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'prodi_id' => $request->prodi_id,
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}