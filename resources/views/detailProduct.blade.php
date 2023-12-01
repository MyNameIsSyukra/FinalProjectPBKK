<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- header -->
    <nav x-data="{ open: false }" class="bg-white">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('homepage') }}">
                            <x-application-logo class="block h-9 w-auto fill-current" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                </div>
                <div class="flex items-center">
                    <form method="GET" action="{{ route('homepage') }}" class="flex">
                        <input type="search" name="search" id="search" class="form-control bg-transparent border-solid" placeholder="Search" value="{{ request('search') }}">

                        <div class="px-3 py-3 py-xl-0"></div>

                        <div class="flex items-center">
                            <label for="genre" class="pr-1 text-nowrap">Category:</label>
                            <select name="genre" id="genre" class="bg-transparent">
                                <option value="all" {{ request('genre') == 'all' ? 'selected' : '' }}>All Genre</option>
                                @foreach (\App\Models\productCategory::all() as $genre)
                                <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>


                <div>
                    <ul class="mt-4 font-medium flex flex-col p-4 md:p-0 md:flex-row md:space-x-8 rtl:space-x-reverse ">
                        <li>
                            <a href="/homepages/MyCart" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Cart</a>
                        </li>
                        <li>
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div>Register</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('registerUser')">
                                            User
                                        </x-dropdown-link>
                                        @csrf
                                        <x-dropdown-link :href="route('registerSeller')">
                                            Seller
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class=" inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Login</a>
                        </li>
                    </ul>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>



    <section class="mt-40">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center ">
            <div class="container p-7">
                <img src="{{asset('storage/images/'.$product->photo)}}" alt="" class=" p-8">
            </div>
            <div class="container p-20">
                <h1 class=" mb-5">
                    {{$product->name}}
                </h1>
                <h2 class=" mb-5">
                    Price : {{$product->price}}
                </h2>
                <h3 class="mb-5">
                    Quantity :{{$product->quantity}}
                </h3>
                <h3 class="mb-5">
                    {{$product->description}}
                </h3>
                <a href="/checkout/{{$product->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>

                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Order Now</a>

            </div>
        </div>
    </section>
</body>

</html>