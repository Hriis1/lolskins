<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/logInStyle.css') }}">
</head>

<body>
    <main>
        <div class="flex-container">
            <div class="content-container">
                <div class="form-container">
                    <form action="{{ route('adminLogIn') }}" method="POST">
                        @csrf
                        <h1 class="text-center">Admin Login</h1>
                        <br><br>
                        <span class="subtitle">EMAIL:</span>
                        <br>
                        <input type="text" name="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <br>
                        <span class="subtitle">PASSWORD:</span>
                        <br>
                        <input type="password" name="password" value="">
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @if(session()->has('logIn'))
                            @if(session('logIn') == 'authFail')
                            <p class="text-danger">Incorrect email or password!</p>
                            @elseif(session('logIn') == 'notAdmin')
                            <p class="text-danger">User not an admin!</p>
                            @endif
                        @endif
                        <br><br>
                        <div class="row d-flex justify-content-around">
                            <input type="submit" value="Log in" class="submit-btn">
                            <a href="{{ route('main') }}" class="link-btn">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <x-flash-message />
</body>

</html>