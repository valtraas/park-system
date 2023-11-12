@extends('layout.dashboard')
@section('search')
    <form action="{{ route('keluar.index') }}">

        <div class="p-2.5 flex items-center rounded-md px-4 duration-300  bg-gray-700 text-white">
            <i class="fa-solid fa-magnifying-glass text-sm"></i>
            <input type="text" placeholder="search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none"
                name="search" value="{{ request('search') }}">
        </div>
    </form>
@endsection
@section('content')
    <div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0 " id="content">
        <p class=" text-2xl text-active mb-10">
            <i class="fa-solid fa-car me-2"></i>
          Operator Keluar
        </p>

        <form action="{{ route('keluar.index') }}" method="get" ref='formFilter'>
            <div class="flex gap-4 items-center">
                <div>
                    <input type="date" class="border p-2 rounded-md" name="tanggalMasuk" ref='tanggalMasuk'
                        value="{{ request('tanggalMasuk') }}" title="Tanggal Masuk">
                </div>
                <div>
                    <input type="date" class="border p-2 rounded-md" name="tanggalKeluar" ref='tanggalKeluar'
                        value="{{ request('tanggalKeluar') }}" title="Tanggal Keluar">
                </div>
                <div>
                    <select name="kendaraan" id="" class="border p-2 rounded-md" ref='kendaraan'>
                        <option value="" selected>Pilih kendaraan</option>
                        @foreach ($kendaraan as $item)
                            <option value="{{ $item->nama }}" {{ $item->nama == request('kendaraan') ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="status" id="" class="border p-2 rounded-md" ref='status'>
                        <option value="" selected>Status Kendaraan</option>
                        <option value="Masuk" {{ request('status') === 'Masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="Keluar" {{ request('status') === 'Keluar' ? 'selected' : '' }}>Keluar</option>

                    </select>
                </div>

                <button class="block bg-active px-2 py-1 rounded-md text-white " title="Filter">
                    <i class="fa-solid fa-filter"></i>
                </button>
                <span class="block bg-active px-2 py-1 rounded-md text-white cursor-pointer" title="Reset"
                    v-on:click='resetFilter'>
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </span>

            </div>

        </form>

        
        <div class="mt-10 overflow-x-auto mb-16 ">
            <table class="table-auto border-collapse border  ">
                <thead>
                    <tr class="text-sm border border-sea">
                        <th class="px-5 py-3  text-active">#</th>
                        <th class="px-5 py-3 text-white bg-sea">Nomor Polisi</th>
                        <th class="px-5 py-3 text-white bg-sea">Kendaraan</th>
                        <th class="px-5 py-3 text-white bg-sea">Tanggal masuk</th>
                        <th class="px-5 py-3 text-white bg-sea">Jam masuk</th>
                        <th class="px-5 py-3 text-white bg-sea">Tanggal Keluar</th>
                        <th class="px-5 py-3 text-white bg-sea">Jam Keluar</th>
                        <th class="px-5 py-3 text-white bg-sea">Harga(Rp)</th> 
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
                            <td class="p-3 border">{{$item->tanggal_keluar ? $item->tanggal_keluar : '-'}}</td>
                            <td class="p-3 border">{{ $item->jam_keluar ? $item->jam_keluar : '-' }}</td>
                            <td class="hidden">{{ $item->user->username }}</td>
                            <td class="p-3 border">{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="p-3 border">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="">
                                @else
                                    <img src="https://source.unsplash.com/200x200?river" alt="">
                                @endif
                            </td>
                            <td class="p-3 border ">
                                <div class="flex gap-3 items-center {{ ($item->status == 'Keluar') ? 'justify-center' : '' }}">

                                    <div>
                                        <span v-on:click="modalDetail('{{ $item->slug }}')"
                                            class="border border-blue-600 p-1 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white duration-200
                                             cursor-pointer block"
                                            title="Detail Kendaraan" >
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                    @if ($item->status !== 'Keluar')
                                    <div>
                                        <span v-on:click="openModal('{{ $item->slug }}')"
                                            class="border border-red-600 p-1 rounded-md text-red-600 hover:bg-red-600 hover:text-white duration-200 cursor-pointer"
                                            title="Keluar">
                                            <i class="fa-solid fa-truck-arrow-right"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div v-if='modal'>
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" style="background: rgba(0, 0, 0, 0.5);">
                        <div class="absolute inset-0 bg-gray-500 opacity-75">
                        </div>
                    </div>
                    <div
                        class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full ">
                        <!-- Konten Modal -->
                        <div class="text-center p-5 mb-5 bg-sea rounded-t-lg text-white flex  items-center justify-between">
                            <p class="">Pembayaran</p>
                            <i class="fa-solid fa-circle-xmark self-start tetx-xl cursor-pointer" v-on:click ="closeModal"></i>
                        </div>
                        <div class="modal-content ">
                            <form :action="`/dashboard/kendaraan/keluar/${slug}`" class="bg-white p-3 text-center"
                                ref="keluarForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="block">Harga</label>
                                    <input type="number" id="harga" class="border rounded-md p-1"
                                        :value="totalHarga" name="harga">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="block">Uang pembayaran</label>
                                    <input type="number" id="bayar" v-model="uangPembayaran"
                                        class="border rounded-md p-1" v-on:change = "kembalian">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="block">Kembalian</label>
                                    <input type="number" class="border rounded-md p-1" readonly :value="kembalianUang">
                                </div>

                                <button v-on:click = "submitPembayaran"
                                    class="hover:bg-active px-4 py-2 rounded-xl hover:text-white border border-active text-active">Submit</button>
                            </form>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

        <div v-if='detail'>
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" style="background: rgba(0, 0, 0, 0.5);">
                        <div class="absolute inset-0 bg-gray-500 opacity-75">
                           
                        </div>
                    </div>
                    <div
                        class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full ">
                        <div class="text-center p-5 mb-10 bg-sea rounded-t-lg text-white flex  items-center justify-between">
                            <p class="">Detail parkir</p>
                            <i class="fa-solid fa-circle-xmark self-start tetx-xl cursor-pointer" v-on:click ="closeModalDetail"></i>
                        </div>
                        <!-- Konten Modal -->
                        <div class="modal-content p-2 ">
                            <div class="mb-5 text-center">
                                <label for="" class="block ">Nomor Polisi</label>
                                <input type="text" id="harga" class="border rounded-md p-1 w-[80%]" :value="nopol"
                                    readonly>
                            </div>
                            <div class="flex justify-center gap-2 items-center mb-5">
                                <div class="mb-3">
                                    <label for="" class="block">Tanggal Masuk</label>
                                    <input type="text"   class="border rounded-md p-1 text-center "
                                        readonly :value="tglMasuk">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="block">Jam Masuk</label>
                                    <input type="text" class="border rounded-md p-1 text-center " readonly :value="jamMasuk">
                                </div>
                            </div>
                            <div class="flex justify-center gap-2 items-center mb-5">
                                <div class="mb-3">
                                    <label for="" class="block">Tanggal Keluar</label>
                                    <input type="text"   class="border rounded-md p-1 text-center"
                                        readonly :value="tglKeluar">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="block">Jam Keluar</label>
                                    <input type="text" class="border rounded-md p-1 text-center" readonly :value="jamKeluar">
                                </div>
                            </div>
                            <div class="mb-5 text-center">
                                <label for="" class="block  ">Operator</label>
                                <input type="text" id="harga" class="border rounded-md p-1 w-[80%] text-center" :value="user"
                                    readonly>
                            </div>
                            <div class="mb-5 text-center">
                                <span v-if="status === 'Keluar'" class="bg-red-500 text-white rounded-lg px-2 py-1">
                                    <span v-text="status"></span> 
                                </span>
                                
                                <span v-if="status === 'Masuk'" class="bg-green-500 text-white rounded-lg px-2 py-1">
                                    <span v-text="status"></span> 
                                </span>
                            </div>

                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

        


    </div>
    <script type="module" defer>
        import {
            createApp
        } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
  
        createApp({
            data() {
                return {
// ------------- Modal detail -----------//
                    detail: false,
                    nopol: '',
                    jamMasuk: '',
                    tglMasuk: '',
                    jamKeluar: '',
                    tglKeluar: '',
                    user : '',
                    status : '',
                    gambar : '',
// ------------- Modal Keluar -----------//
                    modal: false,
                    uangPembayaran: 0,
                    parkir: {!! json_encode($parkir) !!},
                    jumlahJam: 0,
                    totalHarga: 0,
                    kembalianUang: 0,
                    harga: {
                        'Motor': 2000,
                        'Minibus': 4000,
                        'Truck': 6000,
                    },
                    perubahanHarga: {
                        'Motor': 500,
                        'Minibus': 1000,
                        'Truck': 2000,
                    },
                }
            },

            methods: {
                openModal(slug) {
                    this.modal = true;
                    const item = this.parkir.find((parkir) => parkir.slug === slug);
                    const jamMasuk = new Date(item.tanggal_masuk + ' ' + item.jam_masuk);
                    const jamKeluar = new Date(); // Waktu sekarang
                    // Hitung jumlah jam
                    const diffInMillis = jamKeluar - jamMasuk;
                    const jumlahJam = Math.floor(diffInMillis / (1000 * 60 * 60));
                    const totalHarga = this.hitungTotalHarga(item.kendaraan.nama, jumlahJam);
                    console.log(totalHarga);
                    this.slug = slug;
                    this.jumlahJam = jumlahJam;
                    this.totalHarga = totalHarga;
                },
                modalDetail(slug) {
                    this.detail = true;
                    const item = this.parkir.find((parkir) => parkir.slug === slug);
                    console.log(item);
                    this.nopol = item.nomor_polisi
                    console.log(                    this.nopol = item.nomor_polisi
);
                    this.jamMasuk = item.jam_masuk;
                    this.tglMasuk = item.tanggal_masuk;
                    this.jamKeluar = item.jam_keluar;
                    this.tglKeluar = item.tanggal_keluar; 
                    this.status = item.status; 
                    this.user = item.user.nama; 
                    this.gambar = item.gambar; 

                },
                hitungTotalHarga(kendaraan, jumlahJam) {
                    let hargaAwal = this.harga[kendaraan];
                    let perubahanHarga = this.perubahanHarga[kendaraan];

                    // Hitung total harga berdasarkan jumlah jam
                    let totalHarga = hargaAwal + (Math.max(jumlahJam - 1, 0) * perubahanHarga);

                    return totalHarga;
                },
                submitPembayaran() {
                    this.closeModal();
                    this.$refs.keluarForm.submit();
                },
                kembalian() {
                    const uangPembayaran = parseFloat(this.uangPembayaran);
                    const totalHarga = parseFloat(this.totalHarga);
                    this.kembalianUang = uangPembayaran - totalHarga;
                    console.log(this.kembalianUang);
                },

                closeModal() {
                    this.modal = false;
                },
                closeModalDetail() {
                    this.detail = false;
                },
                resetFilter() {
                    this.$refs.tanggalMasuk.value = '';
                    this.$refs.tanggalKeluar.value = '';
                    this.$refs.kendaraan.value = '';
                    this.$refs.status.value = '';
                    this.$refs.formFilter.submit()
                }
            },
        }).mount('#content');
    </script>
@endsection
