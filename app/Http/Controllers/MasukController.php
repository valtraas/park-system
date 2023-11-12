<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Parkir;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operator.masuk.masuk', [
            'title' => 'Kendaraan Masuk',
            'parkir' => Parkir::where('status','masuk')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operator.masuk.create', [
            'title' => 'Kendaraan Masuk',
            'kendaraan' => Kendaraan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $validate = $request->validate([
            'nomor_polisi' => ['required', 'unique:parkir,nomor_polisi'],
            'kendaraan_id' => 'required',
            'gambar' => 'required'
        ]);
        $validate['user_id'] = Auth::user()->id;
        $validate['status'] = 'Masuk';
        $validate['jam_masuk'] = $date;
        $validate['tanggal_masuk'] = $date;
        $validate['harga'] = $request->input('harga');

        $validate['slug'] = Str::slug($validate['nomor_polisi']);
        $validate['gambar'] = $request->file('gambar')->store('gambar-kendaraan');

        // dd($validate);
        Parkir::create($validate);
        notify()->success('Berhasil menambah kendaraan', 'Kendaraan masuk');
        return redirect()->route('masuk.index');
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
    public function edit(Parkir $masuk)
    {
        // dd('h');
        return view('operator.masuk.edit', [
            'title' => 'Edit Kendaraan parkir',
            'parkir' => $masuk,
            'kendaraan' => Kendaraan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parkir $masuk)
    {
        $validate = $request->validate([
            'nomor_polisi' => 'required',
            'kendaraan_id' => 'required',
        ]);
        if ($request->file()) {
            if($masuk->gambar){
                Storage::delete($masuk->gambar);
            }
           $validate['gambar'] = $request->file('gambar')->store('gambar-kendaraan');
        }
        $validate['slug'] = Str::slug($validate['nomor_polisi']);
        $validate['status'] = 'Masuk';
        $validate['user_id'] = Auth::user()->id;

        $masuk->update($validate);
        notify()->success('Berhasil merubah data parkir ');
        return redirect()->route('masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parkir $masuk)
    {
        $masuk->delete();
        return back();
    }
}
