<x-guest-layout>
    <form method="POST" action="{{ route('shopRegister') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nameShop" :value="__('Name')" />
            <x-text-input id="nameShop" class="block mt-1 w-full" type="text" name="nameShop" :value="old('nameShop')" required autofocus autocomplete="nameShop" />
            <x-input-error :messages="$errors->get('nameShop')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required autocomplete="new-address" />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phoneNumber" :value="__('Phone Number')" />

            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" />

            <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
        </div>

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