<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController
{
    public function index()
    {
        $barangs = Barang::paginate(10);
        return response()->json(['data' => $barangs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric',
        ]);

        $barang = Barang::create($request->all());
        return response()->json(['message' => 'Barang created', 'data' => $barang]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'string',
            'harga_barang' => 'numeric',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return response()->json(['message' => 'Barang updated', 'data' => $barang]);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json(['message' => 'Barang deleted']);
    }
}