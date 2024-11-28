<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;  // Import the Supplier model

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('master-data.suppliers.create');
    }

    public function create()
    {
        return view("master-data.suppliers.create");
    }
    public function show($id)
    {

    }


    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validasi_data = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'comment' => 'nullable|string',
        ]);
        // Simpan data ke dalam tabel suppliers
        $supplier = Supplier::create($validasi_data);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');

    }

    /**
     * Display the specified resource.
     */


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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
