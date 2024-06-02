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
                    <form action="{{route("logIn")}}">
                        @csrf
                        <h1>
                            Login
                        </h1>
                        <br>
                        <br>
                        <span class="subtitle">EMAIL:</span>
                        <br>
                        <input type="text" name="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <br>
                        <span class="subtitle">PASSWORD:</span>
                        <br>
                        <input type="password" name="password" value="">
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <br><br>
                        <input type="submit" value="Log in" class="submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <x-flash-message />
</body>

</html>