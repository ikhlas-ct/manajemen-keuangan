<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function index()
    {
        $categories = Categorie::orderBy('type')->get();
        return view('categorie.index', ['categorie'=> $categorie]);
    }


    public function create()
    {
        return view('categorie.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'type' => 'required|in:income,expense',
        ]);

        // ✅ Simpan ke database
        Categorie::create($validated);

        // ✅ Redirect dengan pesan sukses
        return redirect()->route('categorie.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Form edit kategori
     */
    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Categorie $categorie)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'type' => 'required|in:income,expense',
        ]);

        // ✅ Update data
        $category->update($validated);

        return redirect()->route('categorie.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categorie.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
