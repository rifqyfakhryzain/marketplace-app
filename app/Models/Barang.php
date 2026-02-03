<?php

namespace App\Models;

use App\Models\BarangImage;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
        'kategori_id',
        'user_id',
        'status'
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublic($query)
{
    return $query->where('status', 'tersedia');
}
    public function images()
    {
        return $this->hasMany(BarangImage::class);
    }

}
