<x-layout>
    <x-nav type="landing"></x-nav>

    <div class="background">
        <div class="grid-layout">

            {{-- Perk Section --}}
            <section class="perks">
                <h2 class="perks__title">Membership perks</h2>
                <ul class="perks__list">
                    <li class="perks__item">
                        <p class="perks__text">Exclusive 30% Coupon Code</p>
                    </li>
                    <li class="perks__item">
                        <p class="perks__text">Highest Priority Support</p>
                    </li>
                    <li class="perks__item">
                        <p class="perks__text">100% Free (Limited Time)</p>
                    </li>
                    <li class="perks__item">
                        <p class="perks__text">Unlock Member Unique Features</p>
                    </li>
                </ul>
                <h2 class="perks__footer">.... and more to come</h2>
            </section>


            {{-- Register Form Section --}}
            <form method="POST" class="register-form" action="\register">
                @csrf
                <h2 class="register-form__title">Become a member</h2>
                <div class="register-form__input-group">
                    <x-auth-input-field type="text" name="first_name">First Name</x-auth-input-field>
                    <x-auth-input-field type="text" name="last_name">Last Name</x-auth-input-field>
                    <x-auth-input-field type="mail" name="email">Email Address</x-auth-input-field>
                    <x-auth-input-field type="password" name="password">Password</x-auth-input-field>
                    <x-auth-input-field type="tel" name="phone_no">Phone No.</x-auth-input-field>
                </div>

                <input class="register-form__checkbox" type="checkbox" required>
                <span class="register-form__checkbox-text"> I agree to the
                    <a class="register-form__terms" href="/terms">Terms and Conditions</a>
                </span>
                <button class="register-form__button button" type="submit">
                    Join Now
                </button>
                <p class="register-form__footer">Already a member? <a href="/login">Sign In</a></p>
            </form>
        </div>
    </div>

</x-layout>



{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
