@extends('layout.dashboard')
@section('content')
<div class="container mt-20  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
        <p class="text-3xl text-active font-bold"><i class="fa-solid fa-user"></i> Operator</p>
        <div class="form mt-5 border w-1/2 p-3 rounded-md mx-auto shadow-md">
            <form action="{{ route('management.update',['management'=>$operator->username]) }}" method="post" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <div class="nama-lengkap text-center mb-3">
                    <label for="nama_lengkap " class="text-active mb-3 block">Nama Lengkap</label>
                    <input type="text" name="nama"
                        class="block border border-slate-900 px-1 rounded-md h-8 @error('nama')  ring-2 ring-red-600 @enderror mx-auto" placeholder="Masukan nama lengkap" value="{{ old('nama',$operator->nama) }}">
                    @error('nama')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="username text-center mb-3">
                    <label for="username" class="text-active mb-3 block">Username</label>
                    <input type="text" name="username"
                        class="block border border-slate-900 px-1 rounded-md h-8 @error('username')  ring-2 ring-red-600 @enderror mx-auto" placeholder="Masukan Username" value="{{ old('username',$operator->username) }}">
                    @error('username')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="password text-center mb-3">
                    <label for="password" class="text-active mb-3 block">Password</label>
                    <input type="password" name="password"
                        class="block border border-slate-900 px-1 rounded-md h-8 @error('password')  ring-2 ring-red-600 @enderror mx-auto" placeholder="Masukan password">
                    @error('password')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{--  --}}
                <div class="kenaraan mb-3 text-center">
                    <label for="Role" class="text-active mb-3 block">Role</label>
                    <select id="Role" name="role_id"
                        class="block border border-slate-900 w-[200px] rounded-md h-8 @error('role_id') ring-2 ring-offset-red-600 @enderror mx-auto">
                        <option value="" selected disabled>Pilih Role</option>
                        @foreach ($role->skip(1) as $item)
                            <option value="{{ $item->id }}" {{ ($item->id == old('role_id',$operator->role_id) ? 'selected' : '') }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('role_id')
                            <div class="text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                {{--  --}}

                {{--  --}}
              
                <button class=" border border-sea hover:text-white text-active px-4 py-2 rounded-xl hover:bg-sea block mx-auto">
                    Submit
                </button>
                <a href="{{ route('masuk.index') }}"
                    class=" text-sm hover:underline text-active  text-center block mt-3">
                    Kembali
                </a>

            </form>
        </div>

</div>
@endsection
