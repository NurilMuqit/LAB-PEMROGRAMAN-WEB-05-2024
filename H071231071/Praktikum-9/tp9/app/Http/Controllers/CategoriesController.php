<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('categories.index', ['categories' => $data]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi',
            'description.required' => 'Deskripsi harus diisi',
        ]);

        Category::create($request->only(['name', 'description']));
        return redirect()->to('/categories')->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Category::where('id', $id)->update($request->only(['name', 'description']));
        return redirect()->to('/categories')->with('success', 'Data kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return redirect()->to('/categories')->with('success', 'Data kategori berhasil dihapus');
    }
}
