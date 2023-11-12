@extends('layout.dashboard')
@section('search')
    <form action="{{ route('pendapatan.parkir') }}">

        <div class="p-2.5 flex items-center rounded-md px-4 duration-300  bg-gray-700 text-white">
            <i class="fa-solid fa-magnifying-glass text-sm"></i>
            <input type="text" placeholder="search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none"
                name="search" value="{{ request('search') }}">
        </div>
    </form>
@endsection

@section('content')
    <div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
        <div class="flex justify-between items-center mb-10">
            <p class=" text-2xl text-active ">
                <i class="fa-solid fa-coins me-2"></i>
              Pendatapan Parkir
            </p>
            <a href="{{ route('pendapatan.print') }}" target="_blank" class=" border border-active hover:bg-active hover:text-white text-active p-2 rounded-xl duration-200 ">
                <i class="fa-solid fa-print me-2"></i>
             Print
            </a>

        </div>

        <div class="my-10 flex justify-center items-center gap-5">
            <div class="bg-sea text-white rounded-md">
                <p class="mb-4 bg-blue-700 rounded-t-md p-2">Pendapatan Hari Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($hariIni, 0, ',', '.') }}
                </div>
            </div>
            <div class="bg-green-600 text-white rounded-md">
                <p class="mb-4 bg-green-700 rounded-t-md p-2">Pendapatan Minggu Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($minggu, 0, ',', '.') }}

                </div>
            </div>
            <div class="bg-yellow-600 text-white rounded-md">
                <p class="mb-4 bg-yellow-700 rounded-t-md p-2">Pendapatan Bulan Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($bulan, 0, ',', '.') }}

                </div>
            </div>
            <div class="bg-red-600 text-white rounded-md">
                <p class="mb-4 bg-red-700 rounded-t-md p-2">Pendapatan Tahun Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($tahun, 0, ',', '.') }}

                </div>
            </div>
        </div>

        <p class=" text-2xl text-active mb-10 ">
            <i class="fa-solid fa-users me-2"></i>
            Pendapatan Operator
        </p>

        <table class="table-auto border-collapse border border-sea  ">
            <thead>
                <tr class="text-sm">
                    <th class="px-5 py-3  text-active">#</th>
                    <th class="px-5 py-3 text-white bg-sea">Nama</th>
                    <th class="px-5 py-3 text-white bg-sea">Username</th>
                    <th class="px-5 py-3 text-white bg-sea">Pendapatan</th>
                </tr>
            </thead>
            @foreach ($operator as $item)
            <tr>
                <th class="px-5 py-3 border">{{ $loop->iteration }}</th>
                <td class="px-5 py-3 border">{{ $item->nama }}</td>
                <td class="px-5 py-3 border">{{ $item->username }}</td>
                <td class="px-5 py-3 border">Rp {{ number_format($item->pendapatan(), 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tbody>

            </tbody>
        </table>



    </div>
@endsection
