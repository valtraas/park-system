@extends('layout.landing')
@section('content')
<div class=" mx-auto w-[60%] ">
    <div class="mx-auto rounded-2xl  bg-[#0A56A8] text-center   p-6  md:w-1/2 w-96 mb-32 md:mb-52">
        <img src="{{asset('logo.png')}}" alt="" class="mx-auto">
        <p class="text-white font-bold text-2xl md:text-3xl mb-11">Login</p>
        <form action="/login" method="post">
            @csrf
            <label for="username" class="text-xl text-white font-bold">Username</label>
            <input type="text" class="rounded-md h-8 block mx-auto px-2 mb-5 @error('username') is-invalid @enderror" name="username" id="username" autofocus>
             @error('username')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative z-10">
                    {{ $message }}
                </div>
            @enderror
            <label for="password" class="text-xl text-white font-bold">Password</label>
            <input type="password" class="rounded-md h-8 block mx-auto px-2" name="password" id="password">

            <button
                class="mt-10 text-white font-bold bg-active py-3 px-6 rounded-xl hover:bg-yellow-600 duration-500 ">
                Login
            </button>
            <span class="text-white block mt-2" >
                <a href="{{ route('home') }}" class="text-active hover:font-bold text-sm hover:underline duration-200">Kembali</a>
            </span>
        </form>
    </div>
</div>
@endsection