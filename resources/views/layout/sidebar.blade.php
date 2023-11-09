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
                <i class="fa-solid fa-xmark text-2xl cursor-pointer self-start " onclick="toggleSidebar()"></i>
                {{-- <i class="fa-solid fa-xmark text-2xl cursor-pointer lg:invisible self-start"
                    onclick="toggleSidebar()"></i> --}}
            </div>
            <hr class=" mt-2 text-gray-600">
        </div>
        <div class="md:h-[382px] h-[380px]">
            <form
                action="{{ request()->is('dashboard/operator') ? '/dashboard/operator' : (request()->is('dashboard/admin') ? '/dashboard/admin' : (request()->is('dashboard/user') ? '/dashboard/user' : '/dashboard/park')) }}">

                <div class="p-2.5 flex items-center rounded-md px-4 duration-300  bg-gray-700 text-white">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    <input type="text" placeholder="search"
                        class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" name="search"
                        value="{{ request('search') }}">
                </div>
            </form>
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
        <a href="/profile/{{ auth()->user()->username }}" class="block ">
            <div
                class="flex items-center hover:bg-active py-4 px-4 rounded-md duration-500 text-white hover:font-semibold {{ request()->is('profile/*') ? 'bg-active font-bold' : '' }}">
                @if (auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                        class="mt-1  w-14 rounded-full">
                @else
                    <img src="https://source.unsplash.com/200x200?men" alt="" class="mt-1  w-14 rounded-full mx-2">
                @endif
                <div>
                    <h6>{{ auth()->user()->username }}</h6>
                    <span class="text-sm">{{ auth()->user()->role->name }}</span>
                </div>
            </div>
        </a>
    </div>
</aside>
