@extends('layout.dashboard')
@section('content')
    <div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0 relative" id="content">
        <a href={{ route('keluar.create') }}
            class="border border-active w-[20%] p-3 rounded-xl hover:bg-active hover:text-white duration-300">
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
                        <th class="px-5 py-3 text-white bg-sea">Status</th>
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
                            <td class="p-3 border">{{ $item->status }}</td>
                            <td class="p-3 border">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="">
                                @else
                                    <img src="https://source.unsplash.com/200x200?river" alt="">
                                @endif
                            </td>
                            <td class="p-3 border">
                                <div>
                                    <span v-on:click="openModal('{{ $item->slug }}')"
                                        class="border border-red-600 p-1 rounded-md text-red-600 hover:bg-red-600 hover:text-white duration-200 cursor-pointer">
                                        Keluar
                                    </span>
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
                        class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full md:p-2">
                        <!-- Konten Modal -->
                        <div class="modal-content ">
                            <form :action="`/dashboard/kendaraan/keluar/${slug}`" class="bg-white p-3 text-center">
                                <div class="mb-3">
                                    <label for="" class="block">Harga</label>
                                    <input type="number" id="bayar" class="border rounded-md p-1"
                                        :value="totalHarga">
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
                        <button v-on:click ="closeModal"
                            class="mx-auto block bg-slate-400 text-white px-2 py-1 rounded-xl">Close</button>
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
                hitungTotalHarga(kendaraan, jumlahJam) {
                    let hargaAwal = this.harga[kendaraan];
                    let perubahanHarga = this.perubahanHarga[kendaraan];

                    // Hitung total harga berdasarkan jumlah jam
                    let totalHarga = hargaAwal + (Math.max(jumlahJam - 1, 0) * perubahanHarga);

                    return totalHarga;
                },
                submitPembayaran() {
                    this.closeModal();
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
            },
        }).mount('#content');
    </script>
@endsection
