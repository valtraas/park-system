<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operator.keluar.keluar',[
            'title'=>'Kendaraan Keluar',
            'parkir'=>Parkir::latest()->get(),
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
    public function update(Request $request, Parkir $keluar)
    {
        
        $keluar->update([
            'status' => $request->input('status'),
            'user_id' => Auth::user()->id
        ]);
        notify()->success('Kendaraan keluar');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parkir $keluar)
    {
        //..
    }
}
