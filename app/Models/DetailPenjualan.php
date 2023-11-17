<?php

// app/Models/DetailPenjualan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = ['penjualan_id', 'barang_id', 'jumlah_barang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
