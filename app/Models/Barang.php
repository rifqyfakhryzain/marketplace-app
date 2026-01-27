<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
        'kategori_id',
        'user_id',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
