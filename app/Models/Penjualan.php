<?php

// app/Models/Penjualan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['tanggal_penjualan', 'nama_pembeli', 'no_hp_pembeli', 'total_harga_penjualan'];

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
