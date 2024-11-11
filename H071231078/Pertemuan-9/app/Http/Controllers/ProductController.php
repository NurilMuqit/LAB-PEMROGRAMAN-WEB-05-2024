<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();

        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        $products = $products->with('category')->get();

        return view('product', [
            'product' => $products,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Tambahkan validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Simpan produk setelah validasi berhasil
        $createProduct = new Product();
        $createProduct->fill($request->all());
        $createProduct->save();

        return redirect("product")->with('success', 'Product created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('product')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product, $id)
    {
        $product = product::find($id);
        if($product){
            $product->delete();
            return redirect("product")->with('success', 'Product deleted successfully');
        }
    }

}
