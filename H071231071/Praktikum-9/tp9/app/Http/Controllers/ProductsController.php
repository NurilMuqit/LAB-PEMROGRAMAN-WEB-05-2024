<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::all(); // Ambil semua kategori
    $query = Product::query(); // Mulai query produk

    // Cek apakah ada kategori yang dipilih untuk filter
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category); // Filter berdasarkan category_id
    }

    // Ambil produk yang sesuai dengan filter
    $products = $query->get();

    // Hitung total kategori dan total produk
    $totalCategories = $categories->count();
    $totalProducts = Product::count();

    // Kirim produk, kategori, dan total ke view
    return view('products.index', [
        'products' => $products,
        'categories' => $categories,
        'totalCategories' => $totalCategories,
        'totalProducts' => $totalProducts,
    ]);
}


    public function create()
    {
        $categories = Category::all(); // Mengambil semua data kategori dari tabel Category
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan input sementara untuk nama, deskripsi, harga, stok, dan kategori
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        Session::flash('price', $request->price);
        Session::flash('stock', $request->stock);
        Session::flash('category_name', $request->category_name); // Menyimpan nama kategori
    
        // Validasi input, termasuk kategori sebagai nama
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:500',   // Harga harus minimal 1
            'stock' => 'required|integer|min:1',
            'category_name' => 'required', // Pastikan kategori diisi
        ], [
            'name.required' => 'Nama harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'price.required' => 'Harga harus diisi',
            'stock.required' => 'Stok harus diisi',
            'category_name.required' => 'Kategori harus diisi', // Pesan error untuk kategori
        ]);
    
        // Cari kategori berdasarkan nama
        $category = \App\Models\Category::where('name', $request->category_name)->first();
    
        // Jika kategori tidak ditemukan, beri pesan error
        if (!$category) {
            return redirect()->back()->withErrors(['category_name' => 'Kategori tidak ditemukan']);
        }
    
        // Buat data produk dengan ID kategori yang ditemukan
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $category->id, // Simpan ID kategori
        ];
    
        Product::create($data);
        return redirect()->to('/products')->with('success', 'Product added succesfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Mengambil data produk berdasarkan ID
        $product = Product::findOrFail($id);
        // Mengambil semua kategori untuk dropdown kategori di form edit
        $categories = Category::all();

        // Menampilkan halaman edit produk dengan data produk dan kategori
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:500',   // Harga harus minimal 1
            'stock' => 'required|integer|min:1',
            'category_name' => 'required',
        ]);
    
        $product = Product::findOrFail($id);
        $category = Category::where('name', $request->category_name)->first(); // Mendapatkan kategori berdasarkan nama
    
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $category ? $category->id : null, // Menyimpan ID kategori
        ]);
    
        return redirect()->to('/products')->with('success', 'Product updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Product::where('id', $id)->delete();
        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus');
    }
}
