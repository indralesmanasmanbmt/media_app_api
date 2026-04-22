<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Kategori;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'mahasiswa_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'judul_penelitian',
        'tahun_terbit',
        'link_media',
        'gambar_cover',
    ];

    //  RELASI ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    //  RELASI ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
