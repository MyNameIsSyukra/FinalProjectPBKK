<x-guest-layout>
    <form method="POST" action="{{ route('registerSeller') }}">
        @csrf
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profile
            </h2>
            <div class="max-w-xl">
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

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address" :value="__('address')" />

                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" />

                    <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
                </div>

                <div class="mt-4">
                    <x-input-label for="phoneNumber" :value="__('phoneNumber')" />

                    <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" />

                    <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
                </div>
            </div>
        </div>

        <!-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Shop
            </h2>
            <div class="max-w-xl">
                <div>
                    <x-input-label for="nameShop" :value="__('Name')" />
                    <x-text-input id="nameShop" class="block mt-1 w-full" type="text" name="nameShop" :value="old('nameShop')" required autofocus autocomplete="nameShop" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                Email Address
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Email')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="address" name="address" :value="old('address')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                phone
                <div class="mt-4">
                    <x-input-label for="phoneNumber" :value="__('Password')" />

                    <x-text-input id="phoneNumber" class="block mt-1 w-full" type="phoneNumber" name="phoneNumber" required autocomplete="new-phoneNumber" />

                    <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                </div>
            </div>
        </div> -->


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>