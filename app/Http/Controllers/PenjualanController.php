<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController
{
    public function index()
    {
        $penjualans = Penjualan::with('detailPenjualans')->paginate(10);
        return response()->json(['data' => $penjualans]);

    }

     // Metode untuk menampilkan data penjualan berdasarkan range tanggal dengan paginasi
     public function indexByDateRange(Request $request)
     {
         // Validasi input
         $request->validate([
             'start_date' => 'required|date',
             'end_date' => 'required|date|after_or_equal:start_date',
         ]);
 
         // Ambil parameter dari permintaan
         $startDate = $request->input('start_date');
         $endDate = $request->input('end_date');
 
         // Query data penjualan berdasarkan range tanggal
         $penjualans = Penjualan::with('detailPenjualans')
             ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
             ->paginate(10);
 
         return response()->json(['data' => $penjualans]);
     }
 

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'nama_pembeli' => 'required|string',
            'no_hp_pembeli' => 'required|string',
            'total_harga_penjualan' => 'required|numeric',
        ]);

        $penjualan = Penjualan::create($request->all());
        return response()->json(['message' => 'Penjualan created', 'data' => $penjualan]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_penjualan' => 'date',
            'nama_pembeli' => 'string',
            'no_hp_pembeli' => 'string',
            'total_harga_penjualan' => 'numeric',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());
        return response()->json(['message' => 'Penjualan updated', 'data' => $penjualan]);
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return response()->json(['message' => 'Penjualan deleted']);
    }
}