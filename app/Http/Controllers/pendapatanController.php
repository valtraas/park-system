<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\User;
use Carbon\Carbon;

class pendapatanController extends Controller
{
    public function parkir() {
$hariIni = Parkir::where('tanggal_keluar',today())->sum('harga');

$hariAwal = Carbon::now()->startOfWeek(); 
$hariAkhir = Carbon::now()->endOfWeek(); 
$mingguIni = Parkir::whereBetween('tanggal_keluar', [$hariAwal, $hariAkhir])->sum('harga');

$tanggalAwal = Carbon::now()->startOfMonth();
$tanggalAkhir = Carbon::now()->endOfMonth();
$bulanIni = Parkir::whereBetween('tanggal_keluar',[$tanggalAwal,$tanggalAkhir])->sum('harga');

$bulanAwal = Carbon::now()->startOfYear();
$bulanAkhir = Carbon::now()->endOfYear();
$tahunIni = Parkir::whereBetween('tanggal_keluar',[$bulanAwal,$bulanAkhir])->sum('harga');

        return view('admin.pendapatan.pendapatan',[
            'title'=>'Pendapatan',
            'hariIni'=>$hariIni,
            'minggu'=>$mingguIni,
            'bulan'=>$bulanIni,
            'tahun'=>$tahunIni,
            'operator' =>User::where('role_id',3)->Operator(request('search'))->latest()->get()
        ]);
    }
    public function print() {
$hariIni = Parkir::where('tanggal_keluar',today())->sum('harga');

$hariAwal = Carbon::now()->startOfWeek(); 
$hariAkhir = Carbon::now()->endOfWeek(); 
$mingguIni = Parkir::whereBetween('tanggal_keluar', [$hariAwal, $hariAkhir])->sum('harga');

$tanggalAwal = Carbon::now()->startOfMonth();
$tanggalAkhir = Carbon::now()->endOfMonth();
$bulanIni = Parkir::whereBetween('tanggal_keluar',[$tanggalAwal,$tanggalAkhir])->sum('harga');

$bulanAwal = Carbon::now()->startOfYear();
$bulanAkhir = Carbon::now()->endOfYear();
$tahunIni = Parkir::whereBetween('tanggal_keluar',[$bulanAwal,$bulanAkhir])->sum('harga');

        return view('admin.pendapatan.print',[
            'title'=>'Pendapatan',
            'hariIni'=>$hariIni,
            'minggu'=>$mingguIni,
            'bulan'=>$bulanIni,
            'tahun'=>$tahunIni,
            'operator' =>User::where('role_id',3)->Operator(request('search'))->latest()->get()
        ]);
    }
}
