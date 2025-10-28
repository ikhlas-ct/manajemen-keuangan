<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    //     public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $categories = Categorie::orderBy('type')->paginate(10);
        return view('pages.admin.categorie.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:income,expense',
        ]);

        Categorie::create($request->only('name', 'type'));

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Categorie::findOrFail($id);
        return view('pages.admin.categorie.modal-edit', compact('category'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:income,expense',
        ]);

        $category = Categorie::findOrFail($id);
        $category->update($request->only('name', 'type'));

        // return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
        return redirect()->route('manajer.categories.index')
                        ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
