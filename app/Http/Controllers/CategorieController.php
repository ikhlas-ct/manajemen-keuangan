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


    // public function create()
    // {
    //     return view('categorie.create');
    // }


    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:100|unique:categories,name',
        //     'type' => 'required|in:income,expense',
        // ]);

        // Categorie::create($validated);

        // return redirect()->route('pages.admin.categorie.index')
        //     ->with('success', 'Kategori berhasil ditambahkan.');

        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:income,expense',
        ]);

        Categorie::create($request->only('name', 'type'));

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // public function edit($id)
    // {
    //     $category = Category::findOrFail($id);
    //     return view('pages.admin.categorie.edit', compact('category'));
    // }



    public function update(Request $request, $id)
    {
        // $category = Category::findOrFail($id);

        // $validated = $request->validate([
        //     'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        //     'type' => 'required|in:income,expense',
        // ]);

        // $category->update($validated);

        // return redirect()->route('pages.admin.categorie.index')->with('success', 'Kategori berhasil diperbarui.');

        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:income,expense',
        ]);

        $category = Categorie::findOrFail($id);
        $category->update($request->only('name', 'type'));

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $category->delete();

    //     return redirect()->route('pages.admin.categorie.index')->with('success', 'Kategori berhasil dihapus.');
    // }

    {
        $category = Categorie::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
