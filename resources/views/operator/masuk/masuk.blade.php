@extends('layout.dashboard')
@section('search')
    <form action="{{ route('masuk.index') }}">

        <div class="p-2.5 flex items-center rounded-md px-4 duration-300  bg-gray-700 text-white">
            <i class="fa-solid fa-magnifying-glass text-sm"></i>
            <input type="text" placeholder="search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none"
                name="search" value="{{ request('search') }}">
        </div>
    </form>
@endsection

@section('content')
    <div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
        <p class=" text-2xl text-active mb-10 ">
            <i class="fa-solid fa-car me-2"></i>
         Operator Masuk
        </p>
        <a href={{ route('masuk.create') }} class="border border-active w-[20%] p-3 rounded-xl hover:bg-active hover:text-white duration-300" >
                <i class="fa-solid fa-car me-2"></i>
                Kendaraan parkir
            </a>
        <div class="mt-10 overflow-x-auto mb-16 ">
            <table class="table-auto border-collapse border  ">
                <thead>
                    <tr class="text-sm border border-sea">
                        <th class="px-5 py-3  text-active">#</th>
                        <th class="px-5 py-3 text-white bg-sea">Nomor Polisi</th>
                        <th class="px-5 py-3 text-white bg-sea">Kendaraan</th>
                        <th class="px-5 py-3 text-white bg-sea">Tanggal masuk</th>
                        <th class="px-5 py-3 text-white bg-sea">Jam masuk</th>
                        <th class="px-5 py-3 text-white bg-sea">Harga(Rp)</th>
                        <th class="px-5 py-3 text-white bg-sea">Nama Operator</th>
                        <th class="px-5 py-3 text-white bg-sea">Gambar</th>
                        <th class="px-5 py-3 text-white bg-sea">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parkir as $item)
                        <tr class="text-center">
                            <th class="p-3 border">{{ $loop->iteration }}</th>
                            <td class="p-3 border">{{ $item->nomor_polisi }}</td>
                            <td class="p-3 border">{{ $item->kendaraan->nama }}</td>
                            <td class="p-3 border">{{ $item->tanggal_masuk }}</td>
                            <td class="p-3 border">{{ $item->jam_masuk }}</td>
                            <td class="p-3 border">{{ 'Rp ' . number_format($item->kendaraan->harga, 0, ',', '.') }}</td>
                            <td class="p-3 border">{{ $item->user->username }}</td>
                            <td class="p-3 border">
                                @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="">    
                                @else
                                <img src="https://source.unsplash.com/200x200?river" alt="">    
                                    
                                @endif
                            </td>
                            <td class="p-3 border">
                                   <div>
                                        <a href="{{ route('masuk.edit',['masuk'=>$item->slug]) }}" class="border border-yellow-500 p-1 rounded-md text-yellow-500 hover:bg-yellow-500 hover:text-white duration-200 ">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
