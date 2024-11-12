<?php

namespace App\Http\Controllers;

use App\Models\inventory_logs;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InventoryLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan eager loading untuk memuat data produk yang terkait dengan log inventaris
        $inventoryLogs = inventory_logs::with('product')->get();
    
        return view('inventory.index', [
            'inventoryLogs' => $inventoryLogs,
        ]);
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('product_id', $request->product_id);
        Session::flash('type', $request->type);
        Session::flash('quantity', $request->quantity);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:sold,restock',
            'quantity' => 'required|integer|min:1',
        ], [
            'product_id.required' => 'Product ID must be filled!',
            'product_id.exists:products,id' => 'Product ID is not exist!',
            'type.required' => 'Type must be filled!',
            'type.in:sold,restock' => 'Type is not correct!',
            'quantity.required' => 'Quantity must be filled!',
            'quantity.min:1' => 'Quantity minimal is 1!'
        ]);


        $product = Product::find($request->product_id);

        if($request->type === 'sold') {
            $product->stock -= $request->quantity;
        } elseif ($request->type === 'restock') {
            $product->stock += $request->quantity;
        }

        $product->save();

        $data = [
            'product_id' => $request->product_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
        ];
        inventory_logs::create($data);
        return redirect()->to('/inventoryLogs')->with('success', 'Inventory Log data is successfully created');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        inventory_logs::where('id', $id)->delete();
        return redirect()->to('/inventoryLogs')->with('success', 'Inventory Log data is successfully deleted!');
    }
}