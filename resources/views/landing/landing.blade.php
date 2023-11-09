@extends('layout.landing')
@section('content')
    <div class="mx-10 mt-10">
        <div class="flex items-center justify-center gap-28 md:mt-0 mt-20">
            <div class="desc md:w-1/2 ">
                <p class="text-4xl text-white font-bold mb-10">Menghadirkan pengalaman parkir yang berbeda
                    dari yang lain
                </p>
                <p class="my-8 text-xl ">kami hadir untuk membantu mengamankan kendaraan selama 24jam.</p>
                <div class="flex">
                    @auth
                        @can('admin')
                            <a href="{{ route('parkir.index') }}" class=" block">
                                <div
                                    class="button bg-active w-32 text-center rounded-md text-white hover:bg-yellow-600 font-bold py-3 px-6 md:w-44 duration-500 animation animate-bounce-slow">
                                    Dashboard
                                </div>
                            </a>
                        @endcan
                        @can('masuk')
                            <a href="{{ route('masuk.index') }}" class=" block">
                                <div
                                    class="button bg-active w-32 text-center rounded-md text-white hover:bg-yellow-600 font-bold py-3 px-6 md:w-44 duration-500 animation animate-bounce-slow">
                                    Dashboard
                                </div>
                            </a>
                        @endcan
                        @can('keluar')
                        <a href="{{ route('keluar.index') }}" class=" block">
                            <div
                                class="button bg-active w-32 text-center rounded-md text-white hover:bg-yellow-600 font-bold py-3 px-6 md:w-44 duration-500 animation animate-bounce-slow">
                                Dashboard
                            </div>
                        </a>
                        @endcan
                    @else
                        <a href="{{ route('login.index') }}" class=" block">
                            <div
                                class="button bg-active w-32 text-center rounded-md text-white hover:bg-yellow-600 font-bold md:py-3 md:px-6 py-2 px-4 md:w-44 duration-500">
                                Login
                            </div>
                        </a>

                    @endauth

                </div>
            </div>
            <div class=" w-1/2 md:block hidden ">
                <img src="{{ asset('mobil.png') }}" alt="" class="mx-auto" width="400">
            </div>
        </div>
    </div>

    <script>
        const dropdown = document.querySelector(".dropdown");
        const dropdownMenu = document.querySelector(".dropdown-menu");

        dropdown.addEventListener("click", function() {
            dropdownMenu.classList.toggle("hidden");
        });
    </script>
@endsection
