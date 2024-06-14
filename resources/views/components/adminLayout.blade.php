<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Skins</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.tiny.cloud/1/67zhhvrbn1k1ztf3hnenwegscdmjzl1y46vo89ek8g2hzh7q/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>

    {{-- Custom --}}
    <link rel="stylesheet" href="{{ asset('css/headerStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/baseStyle.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo-nav">
            <div class="logo">
                <img src="{{ asset('img/admin_panel_larger_logo.png') }}" alt="Admin panel">
            </div>
            <div class="nav-buttons">
                <a href="{{route('main')}}">Home</a>
            </div>
        </div>
        <div class="auth-buttons">
            @if(isset($user))
            <a href="">{{$user->username}}</a>
            <a href="{{ route('logOut') }}">Log Out</a>
            @endif
        </div>
    </header>
    <main>
        {{$slot}}
    </main>

    <x-flash-message />

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c275ff90f1.js" crossorigin="anonymous"></script>

    {{-- Custom --}}
    <script src="{{asset('js/utils.js')}}"></script>
    {{-- <script src="{{asset('js/header.js')}}"></script>
    <script src="/js/utils.js"></script> --}}
</body>

</html>