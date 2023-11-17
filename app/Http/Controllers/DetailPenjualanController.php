<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenjualan;

class DetailPenjualanController
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::paginate(10);
        return response()->json(['data' => $detailPenjualans]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|integer',
        ]);

        $detailPenjualan = DetailPenjualan::create($request->all());
        return response()->json(['message' => 'Detail Penjualan created', 'data' => $detailPenjualan]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penjualan_id' => 'exists:penjualans,id',
            'barang_id' => 'exists:barangs,id',
            'jumlah_barang' => 'integer',
        ]);

        $detailPenjualan = DetailPenjualan::findOrFail($id);
        $detailPenjualan->update($request->all());
        return response()->json(['message' => 'Detail Penjualan updated', 'data' => $detailPenjualan]);
    }

    public function destroy($id)
    {
        $detailPenjualan = DetailPenjualan::findOrFail($id);
        $detailPenjualan->delete();
        return response()->json(['message' => 'Detail Penjualan deleted']);
    }
}