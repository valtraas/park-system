<aside>
    <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="toggleSidebar()">
        <i class="fa-solid fa-list px-4 py-2 bg-active rounded-md"></i>
    </span>
    <div
        class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[250px] overflow-y-auto text-center bg-sea flex flex-col justify-between ">
        <div class="text-white text-xl">
            <div class="logo  flex items-center justify-between">
                <a href="/" class="block mx-auto">
                    <img src="{{ asset('logo.png') }}" alt="Pt.parkir Indonesia">
                </a>
                {{-- <i class="fa-solid fa-xmark text-2xl cursor-pointer self-start " onclick="toggleSidebar()"></i> --}}
            </div>
            <hr class=" mt-2 text-gray-600">
        </div>
        <div class="md:h-[382px] h-[380px]">
            @yield('search')
            @can('admin')
                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  {{ request()->Routeis('parkir.*') ? 'bg-active font-bold' : '' }} text-white hover:bg-active hover:font-bold">
                    <i class="fa-solid fa-square-parking"></i>
                    <a href="{{ route('parkir.index') }}" class="text-[15px] ml-4 ">Data Parkir</a>
                </div>

                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  {{ request()->Routeis('management.*') ? 'bg-active font-bold' : '' }} text-white hover:bg-active hover:font-bold">
                    <i class="fa-solid fa-users"></i>
                    <a href="{{ route('management.index') }}" class="text-[15px] ml-4 ">User Management</a>
                </div>

                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  {{ request()->Routeis('pendapatan.parkir') ? 'bg-active font-bold' : '' }} text-white hover:bg-active hover:font-bold">
                    <i class="fa-solid fa-coins"></i>
                    <a href="{{ route('pendapatan.parkir') }}" class="text-[15px] ml-4 ">Pendapatan</a>
                </div>
            @endcan
            @can('masuk')
                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  {{ request()->Routeis('masuk.*') ? 'bg-active font-bold' : '' }} text-white hover:bg-active hover:font-bold">
                    <i class="fa-solid fa-square-parking"></i>
                    <a href="/dashboard/park" class="text-[15px] ml-4 ">List Kendaraan</a>
                </div>
            @endcan
            @can('keluar')
                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  {{ request()->Routeis('keluar.*') ? 'bg-active font-bold' : '' }} text-white hover:bg-active hover:font-bold">
                    <i class="fa-solid fa-square-parking"></i>
                    <a href="/dashboard/park" class="text-[15px] ml-4 ">List Kendaraan</a>
                </div>
            @endcan


            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-500  hover:bg-button hover:font-bold text-white">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button>
                        <span class="text-[15px] mr-2 ">Log out</span>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
            <div
                class="flex items-center  py-4 px-4 rounded-md duration-500 text-white ">
                    <img src="{{ asset('profile.png') }}" alt="" class="mt-1  w-14 rounded-full mx-2">
                <div>
                    <h6>{{ auth()->user()->username }}</h6>
                    <span class="text-sm">{{ auth()->user()->role->name }}</span>
                </div>
            </div>
    </div>
</aside>
