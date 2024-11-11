<?php

namespace App\Http\Controllers;

use App\Models\inventoryLog;
use App\Models\product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $inventoryLogs = InventoryLog::all();
        return view('inventoryLog', [
            'products' => $products,
            'inventoryLogs' => $inventoryLogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $inventoryLog = new InventoryLog();
        $inventoryLog->fill($request->all());
        $inventoryLog->save();

        $product = Product::findOrFail($request->product_id);
        if ($request->type == 'restock') {
            $product->stock += $request->quantity;
        } elseif ($request->type == 'sold') {
            $product->stock -= $request->quantity;
        }
        $product->save();

        return redirect('inventoryLog')->with('success', 'Inventory log added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryLog $inventoryLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryLog $inventoryLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryLog $inventoryLog, $id)
    {
        $inventoryLog = InventoryLog::find($id);
        if ($inventoryLog) {
            $inventoryLog->delete();
            return redirect('inventoryLog')->with('success', 'Inventory log deleted successfully');
        }
        return redirect('inventoryLog')->with('error', 'Inventory log not found');
    }
}
