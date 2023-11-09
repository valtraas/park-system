@extends('layout.dashboard')
@section('content')
<div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
    <div class="mt-10 overflow-x-auto mb-16 ">
        <table class="table-auto border-collapse border border-sea  ">
            <thead>
                <tr class="text-sm">
                    <th class="px-5 py-3  text-active">#</th>
                    <th class="px-5 py-3 text-white bg-sea">Nomor Polisi</th>
                    <th class="px-5 py-3 text-white bg-sea">Kendaraan</th>
                    <th class="px-5 py-3 text-white bg-sea">Tanggal masuk</th>
                    <th class="px-5 py-3 text-white bg-sea">Jam masuk</th>
                    <th class="px-5 py-3 text-white bg-sea">Harga(Rp)</th>
                    <th class="px-5 py-3 text-white bg-sea">Nama Operator</th>
                        <th class="px-5 py-3 text-white bg-sea">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection