<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Parkir;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
        return view('admin.parkir.parkir',[
            'title'=>'List Parkir',
            'parkir'=>Parkir::Park(request(['search','tanggalMasuk','tanggalKeluar','status','kendaraan']))->latest()->get(),
            'kendaraan'=>Kendaraan::all()
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
        //
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
        //
    }
}
