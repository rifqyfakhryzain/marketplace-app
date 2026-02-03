<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangImage extends Model
{
    protected $table = 'barang_images';

    protected $fillable = [
        'barang_id',
        'image_path',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
