<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../image/icon.png">
    <title>Parking | {{ $title }}</title>
    <script src="https://kit.fontawesome.com/72bae55f93.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400;600;700&family=Fira+Sans:wght@500&family=Poppins:wght@300;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/72bae55f93.js" crossorigin="anonymous"></script>
    @notifyCss
</head>

<body class="h-[100vh] bg-ground font-poppin overflow-hidden">
    @include('notify::components.notify')

    <div class="p-5 flex justify-between">
        <img src="{{ asset('logo.png') }}" alt="" class="w-28">
        @auth
        <div>
            <div class="flex items-center gap-2 cursor-pointer" id="profile">
                <img src="{{ asset('profile.png') }}" alt="" class="rounded-full inline mx-2">
                <span class="text-white">{{ Auth::user()->username }}</span>
                <i class="fa-solid fa-angle-down text-white"></i>
            </div>
            <div class="hover:bg-red-600 mt-1 rounded-md p-2 group duration-200 bg-white hidden" id="log">
                <form action="{{ route('logout') }}" method="post" class=" text-center">
                    @csrf
                    <button class="text-red-600 group-hover:text-white duration-200 ">Logout</button>
                </form>
            </div>
        </div>
        @endauth
    
    </div>
    <div>
        <notify-messages />
        @yield('content')
    </div>

    @notifyJs
    <script>
        const profile = document.querySelector('#profile')
        const log = document.querySelector('#log')
        profile.addEventListener('click',()=>{
            log.classList.toggle('hidden')
        })
    </script>
</body>

</html>
