<x-app-layout>
    <x-nav type="auth"></x-nav>

    <div class="background">
        <div class="grid-layout">

            <!-- Register Form -->
            <form method="POST" class="register-form" action="{{ route('login') }}">
                @csrf
                <h2 class="register-form__title">Login</h2>
                <div class="register-form__input-group">
                    <x-auth-input-field type="mail" name="email">Email Address</x-auth-input-field>
                    <x-auth-input-field type="password" name="password">Password</x-auth-input-field>
                </div>

                <a href="">Forgot Password?</a>
                <div class="register-form__checkbox-group">
                    <input class="register-form__checkbox" type="checkbox">
                    <span class="register-form__checkbox-text"> Remember password on this device?</span>
                </div>
                <button class="register-form__button button" type="submit">
                    Sign In
                </button>
            </form>

            <!-- Cover Section -->
            <section class="cover">
                <img src="images/svg/cocktail.svg" alt="cocktail image" />
                <h2 class="cover__title">Don't have an account?</h2>
                <a class="cover__footer" href="{{ route('register') }}">Become a Member!</a>
            </section>


        </div>
    </div>

</x-app-layout>
