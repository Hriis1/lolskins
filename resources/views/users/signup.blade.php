<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/logInStyle.css') }}">
</head>

<body>
    <main>
        <div class="flex-container">
            <div class="content-container">
                <div class="form-container">
                    <form action="{{route('signUp')}}">
                        <h1>
                            Sign up
                        </h1>
                        <br>
                        <br>
                        <span class="subtitle">USERNAME:</span>
                        <br>
                        <input type="text" name="username" value="">
                        <br>
                        <span class="subtitle">EMAIL:</span>
                        <br>
                        <input type="text" name="email" value="">
                        <br>
                        <span class="subtitle">PASSWORD:</span>
                        <br>
                        <input type="password" name="password" value="">
                        <br><br>
                        <div class="row d-flex justify-content-around">
                            <input type="submit" value="Sign Up" class="submit-btn">
                            <a href="{{route('main')}}" class="link-btn">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>