<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    // BUYER - HOME
    public function index()
    {
        $barangs = Barang::with(['kategori', 'penjual'])
            ->where('status', 'tersedia')
            ->latest()
            ->get();

        return view('home', compact('barangs'));
    }

    // BUYER - DETAIL
    public function show($id)
    {
        $barang = Barang::with(['penjual', 'kategori'])->findOrFail($id);
        return view('produk.show', compact('barang'));
    }

    // SELLER - PRODUK SAYA
    public function sellerIndex()
    {
        $barangs = Barang::with('kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('seller.barang.index', compact('barangs'));
    }

    // SELLER - FORM TAMBAH
    public function create()
    {
        $kategori = Kategori::all();
        return view('seller.barang.create', compact('kategori'));
    }

    // SELLER - SIMPAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'status'      => 'required|in:tersedia,nonaktif',
        ]);

        $validated['user_id'] = Auth::id();

        Barang::create($validated);

        return redirect()
            ->route('seller.products')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // SELLER - UPDATE
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'status'      => 'required|in:tersedia,nonaktif',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('seller.products')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function edit($id)
    {
        $barang = Barang::where('user_id', Auth::id())
            ->findOrFail($id);

        $kategori = Kategori::all();

        return view('seller.barang.edit', compact('barang', 'kategori'));
    }


    // SELLER - HAPUS
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->user_id !== Auth::id()) {
            abort(403);
        }

        $barang->delete();

        return redirect()->back()
            ->with('success', 'Produk berhasil dihapus');
    }

    public function sellerShow(Barang $barang)
    {
        // CEGAH AKSES PRODUK ORANG LAIN
        if ($barang->user_id !== Auth::id()) {
            abort(403);
        }

        $barang->load('kategori');

        return view('seller.barang.show', compact('barang'));
    }
}
