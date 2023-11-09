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
    @include('notify::components.notify')

    @include('layout.sidebar')
    <notify-messages />

    @yield('content')
    @notifyJs

    <script>
    const content = document.querySelector('#content')
        function toggleSidebar() {
            content.classList.toggle('md:pl-[280px]')
            document.querySelector('.sidebar').classList.toggle('hidden')
            document.querySelector('.sidebar').classList.toggle('left-[-300px]')
        }

        function previewImage() {
  // menangkap inputan image
  const image = document.querySelector('#image');
  
  // mengambil tag image
  const imgPreview = document.querySelector('.img-preview');
  
  // membuat display block pada tag img kosong
  imgPreview.style.display = 'block';
  
  // mengambil data gambar
  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);
  
  // ketika di load
  oFReader.onload = function(oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}
    </script>
   
</body>
</html>