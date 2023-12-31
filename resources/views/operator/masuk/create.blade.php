@extends('layout.dashboard')
@section('content')
    <div class="container mt-20  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
        <p class="text-3xl text-active font-bold"><i class="fa-solid fa-car"></i> Parkir Masuk</p>
        <div class="form mt-5 border w-1/2 p-3 rounded-md mx-auto shadow-md">
            <form action="{{ route('masuk.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="nomor-polisi text-center">
                    <label for="plat " class="text-active mb-3 block">Nomor Polisi</label>
                    <input type="text" name="nomor_polisi"
                        class="block border border-slate-900 px-1 rounded-md h-8 @error('nomor_polisi')  ring-2 ring-red-600 @enderror mx-auto"
                        placeholder="Masukan nomor polisi">
                    @error('nomor_polisi')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{--  --}}
                <div class="kenaraan my-12 text-center">
                    <label for="kendaraan" class="text-active mb-3 block">Jenis Kendaraan</label>
                    <select id="kendaraan" name="kendaraan_id"
                        class="block border border-slate-900 w-[200px] rounded-md h-8 @error('kendaraan_id') ring-2 ring-offset-red-600 @enderror mx-auto" v-model="kendaraan">
                        <option value="" selected disabled>Pilih kendaraan</option>
                        @foreach ($kendaraan as $item)
                            <option value="{{ $item->id }}" >{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('kendaraan_id')
                            <div class="text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <input type="hidden" :value="calculateBiaya()" name="harga">
                {{--  --}}

                {{--  --}}
                <div class="gambar text-center">
                    <label for="gambar " class="text-active mb-3 block">Gambar</label>
                    <img class="img-preview my-3 w-80 mx-auto">
                    <input type="file"
                        class="block border border-slate-900  rounded-md h-8 @error('gambar') ring-2 ring-red-600 @enderror mx-auto"
                        name="gambar" onchange="previewImage()" id="image">
                    @error('gambar')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button
                    class="mt-10 border border-sea hover:text-white text-active px-4 py-2 rounded-xl hover:bg-sea block mx-auto">
                    Submit
                </button>
                <a href="{{ route('masuk.index') }}" class=" text-sm hover:underline text-active  text-center block mt-3">
                    Kembali
                </a>

            </form>
        </div>

    </div>
    <script type="module">
        import {
            createApp,
            ref
        } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
        createApp({
            data() {
                return {
                    kendaraan: ''
                }
            },
            methods: {
            calculateBiaya() {
                if (this.kendaraan === '1') {
                    return 2000;
                } else if (this.kendaraan === '2') {
                    return 4000;
                } else if (this.kendaraan === '3') {
                    return 6000;
                } else {
                    return '';
                }
            }
        }
        }).mount('#content')
    </script>
@endsection
