<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | {{ $title }}</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/72bae55f93.js" crossorigin="anonymous"></script>
    @notifyCss

    <link
        href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400;600;700&family=Fira+Sans:wght@500&family=Poppins:wght@300;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('image/icon.png') }}">
</head>

<body class="font-poppin">

    <div class="container px-20 ">
        <div>
            <img src="{{ asset('logo.png') }}" alt="" class="mx-auto">
            <p class="text-center text-xl my-2">PENDAPATAN PARKIR PT. PARKIR INDONESIA</p>
        </div>

        <p class=" text-2xl text-active mb-10">
            <i class="fa-solid fa-coins me-2"></i>
            Pendatapan Parkir
        </p>

        <div class="my-10 flex justify-center items-center gap-5">
            <div class="bg-sea text-white rounded-md">
                <p class="mb-4 bg-blue-700 rounded-t-md p-2">Pendapatan Hari Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($hariIni, 0, ',', '.') }}
                </div>
            </div>
            <div class="bg-green-600 text-white rounded-md">
                <p class="mb-4 bg-green-700 rounded-t-md p-2">Pendapatan Minggu Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($minggu, 0, ',', '.') }}

                </div>
            </div>
            <div class="bg-yellow-600 text-white rounded-md">
                <p class="mb-4 bg-yellow-700 rounded-t-md p-2">Pendapatan Bulan Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($bulan, 0, ',', '.') }}

                </div>
            </div>
            <div class="bg-red-600 text-white rounded-md">
                <p class="mb-4 bg-red-700 rounded-t-md p-2">Pendapatan Tahun Ini </p>
                <div class="p-2 text-center text-2xl">
                    Rp {{ number_format($tahun, 0, ',', '.') }}

                </div>
            </div>
        </div>

        <p class=" text-2xl text-active mb-10 ">
            <i class="fa-solid fa-users me-2"></i>
            Pendapatan Operator
        </p>

        <table class="table-auto border-collapse border border-sea  mx-auto">
            <thead>
                <tr class="text-sm">
                    <th class="px-5 py-3  text-active">#</th>
                    <th class="px-5 py-3 text-white bg-sea">Nama</th>
                    <th class="px-5 py-3 text-white bg-sea">Username</th>
                    <th class="px-5 py-3 text-white bg-sea">Pendapatan</th>
                </tr>
            </thead>
            @foreach ($operator as $item)
                <tr>
                    <th class="px-5 py-3 border">{{ $loop->iteration }}</th>
                    <td class="px-5 py-3 border">{{ $item->nama }}</td>
                    <td class="px-5 py-3 border">{{ $item->username }}</td>
                    <td class="px-5 py-3 border">Rp {{ number_format($item->pendapatan(), 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tbody>

            </tbody>
        </table>
    </div>

    <script>
    </script>
</body>

</html>
