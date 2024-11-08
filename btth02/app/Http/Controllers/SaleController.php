<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('medicine')->paginate(10);
        return view('sales.index', compact('sales'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::all();
        return view('sales.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required',
            'quantity' => 'required',
            'sale_date' => 'required|date',
            'customer_phone' => 'required|max:10',
        ]);

        Sale::create($request->all());

        return redirect()->route('sales.index')->with('success', 'Thêm mới thành công!');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $medicines = Medicine::all();
        return view('sales.edit', compact('sale', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_id' => 'required',
            'quantity' => 'required',
            'sale_date' => 'required|date',
            'customer_phone' => 'required|max:10',
        ]);
        $sale = Sale::find($id);
        $sale->update($request->all());
        return redirect()->route('sales.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
