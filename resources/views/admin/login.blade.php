<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Admin Login | Ngapali Paradise Hotel</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Sacramento&family=Newsreader:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
    @livewireStyles

</head>

<body class="admin">

    <div class="container container__admin-login">
        <img class="admin-login__logo" src="{{ asset('images/logos/no_text.png') }}" alt="logo of Ngapali Paradise Hotel" width="100px">

        <!-- Admin Login Form -->
        <form class="admin-login__form" method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email Address -->
            <div class="admin-login__input-group">
                <label class="admin-login__label" for="email">Email</label>
                <input class="admin-login__input" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" />
                @error('email')
                    <p class="admin-login__input-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="admin-login__input-group">
                <label class="admin-login__label" for="password">Password</label>
                <input class="admin-login__input" id="password" name="password" type="password" value="{{ old('password') }}" required autocomplete />
                @error('password')
                    <p class="admin-login__input-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="admin-login__input-group">
                <input class="admin-login__checkbox" id="remember_me" name="remember" type="checkbox" />
                <span class="admin-login__checkbox-text" for="remember">Remember me?
                </span>
            </div>

            <!-- Login Button -->
            <button class="admin-login__button button button--primary" type="submit">
                Login
            </button>
        </form>
        <a class="admin-login__link" href="{{ route('index') }}">
            &#8592; Go to hotel page
        </a>
    </div>



    @livewireScripts

    <!-- Scripts -->
    @yield('scripts')
    @livewire('livewire-ui-modal')
</body>

</html>
