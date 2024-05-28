<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="{{ asset('css/logInStyle.css') }}">
</head>

<body>
    <main>
        <div class="flex-container">
            <div class="content-container">
                <div class="form-container">
                    <form action="/action_page.php">
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
                        <input type="submit" value="SUBMIT" class="submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>