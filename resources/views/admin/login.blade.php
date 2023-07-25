<x-admin-layout>

    <div class="container container__admin-login">

        <img class="admin-login__logo"
            src="{{ asset('images/logos/no_text.png') }}"
            alt="logo of Ngapali Paradise Hotel"
            width="100px">

        <!-- Admin Login Form -->
        <form class="admin-login__form"
            method="POST"
            action="{{ route('admin.login') }}">
            @csrf

            <!-- Email Address -->
            <div class="admin-login__input-group">
                <label class="admin-login__label"
                    for="email">Email</label>
                <input class="admin-login__input"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email" />
                @error('email')
                    <p class="admin-login__input-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="admin-login__input-group">
                <label class="admin-login__label"
                    for="password">Password</label>
                <input class="admin-login__input"
                    id="password"
                    name="password"
                    type="password"
                    value="{{ old('password') }}"
                    required
                    autocomplete />
                @error('password')
                    <p class="admin-login__input-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="admin-login__input-group">
                <input class="admin-login__checkbox"
                    id="remember_me"
                    name="remember"
                    type="checkbox" />
                <span class="admin-login__checkbox-text"
                    for="remember">Remember me?
                </span>
            </div>

            <!-- Login Button -->
            <button class="admin-login__button button button--primary"
                type="submit">
                Login
            </button>
        </form>
    </div>


</x-admin-layout>
