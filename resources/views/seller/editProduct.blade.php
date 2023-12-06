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
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('homepages') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:flex">
                        <a href="/homepages" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Dashboard</a>
                    </div>
                </div>

                <div>
                    <ul class=" hidden mt-4 font-medium md:flex flex-col p-4 md:p-0 md:flex-row md:space-x-8 rtl:space-x-reverse ">
                        @if (Auth::user() != Null)

                        @if (Auth::user()->role == 1)
                        <li>
                            <a href=" {{ route('sellerDashboard') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Seller Dashboard</a>
                        </li>
                        <li>
                            <a href="/sellerDashboard/MyOrderSeller" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" aria-current="page">My Order</a>
                        </li>
                        @endif

                        @endif

                        @if (Auth::user()->role == 0)
                        <li>
                            <a href="/homepages/MyCart" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Cart</a>
                        </li>
                        @endif
                        <li>
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
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
                <x-responsive-nav-link :href="route('homepages')" :active="request()->routeIs('homepages')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

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
                    <a href="{{ route('sellerDashboard') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Seller Dashboard</a>
                    <a href="/sellerDashboard/MyOrderSeller" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" aria-current="page">My Order</a>
                </div>
            </div>
        </div>
    </nav>
    <section class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="border-8 border-white w-1/2 p-10 custom-bg bg-slate-400 shadow-sm">
            <h1>Edit Product {{$product->name}}</h1>
            <form action="/sellerDashbord/MyProductSellerEdit/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label for="name" class="text-white">Name</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="w-full rounded-md py-2 px-3 border border-gray-300  text-black">
                </div>
                <div class="mb-4">
                    <label for="description" class="text-white">Description</label>
                    <textarea id="description" name="description" class="w-full rounded-md py-2 px-3 border border-gray-300  text-black">{{ $product->description }}</textarea>
                </div>
                <div class="flex items-center mb-4">
                    <label for="product_category" class="pr-1 text-white text-nowrap">Category:</label>
                    <select name="product_category" id="product_category" class="py-1  text-white">
                        @foreach (\App\Models\productCategory::all() as $product_category)
                        <option value="{{ $product_category->name }}" {{ request('product_category') == $product_category->name }}>
                            {{ $product_category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="price" class="text-white">Price</label>
                    <input type="number" id="price" name="price" value="{{ $product->price }}" class="w-full rounded-md py-2 px-3 border border-gray-300  text-black">
                </div>

                <div class="mb-4">
                    <label for="quantity" class="text-white">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" class="w-full rounded-md py-2 px-3 border border-gray-300  text-black">
                </div>

                <div class="mb-4">
                    <label for="image" class="text-white">Image</label>
                    <input id="photo" type="file" name="image" class=" text-black">
                </div>
                <div>
                    <button type="submit" class="mt-4 bg-purple-500 hover:bg-white text-white hover:text-purple-500 rounded-md py-2 px-4 transition duration-300">Update</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>