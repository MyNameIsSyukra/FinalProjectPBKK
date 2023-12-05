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
    <header>

        <!-- header -->
        <nav x-data="{ open: false }" class="bg-black">
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
                            <a href="/homepages" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-black hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Dashboard</a>
                        </div>
                    </div>

                    <div>
                        <ul class="hidden mt-4 font-medium md:flex flex-col p-4 md:p-0 md:flex-row md:space-x-8 rtl:space-x-reverse ">
                            <!-- <li>
                            <a href="#" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" aria-current="page">Home</a>
                        </li> -->
                            <li>
                                <a href="{{ route('shopRegisterview') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-black hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">addToko</a>
                            </li>
                            <li>
                                <a href="{{ route('orderViewSeller') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-black  hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">MyOrder</a>
                            </li>
                            <!-- <li>
                            <a href="{{ route('shopRegisterview') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">addToko</a>
                        </li> -->
                            <li>
                                <!-- Settings Dropdown -->
                                <div class="hidden sm:flex sm:items-center">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-black hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
                        <a href="{{ route('shopRegisterview') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-black hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">addToko</a>
                        <a href="{{ route('orderViewSeller') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-black  hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">MyOrder</a>
                    </div>
                </div>
            </div>
        </nav>

    </header>
    <section>
        <!-- <div class=" container mx-auto p-4 mt-10" style=" z-index: 2;color: white; font-weight: bold; border: 3px solid #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; width: 80%; padding: 20px;"> -->
        <p class="text-2xl font-bold mb-4">Dashboard Seller</p>
        <a href="/sellerDashboard/addProduct" class="bg-blue-500 mb-4 text-white px-4 py-2 rounded-md">Add Product</a>

        @foreach ($shop as $shopName)
        <div>
            <h1 class="text-xl font-semibold my-4">{{ $shopName->name }}</h1>
            <h1 class="mb-2">Items:</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse table-auto">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-white">
                            <th class="px-4 py-2">Product Name</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2"></th>
                            <!-- Add more table headers here if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Product::all()->where('shop_id', $shopName->id) as $item)
                        <tr class="border-b dark:border-gray-700 text-center">
                            <td class="px-4 py-2">{{ $item->name }}</td>
                            <td class="px-4 py-2">{{ $item->price }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">
                                <form method="GET" action="/sellerDashbord/MyProductSellerEdit/{{$item->id}}">
                                    <!-- <a href="/sellerDashboard/MyOrderSellerDelete/{{$item->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</a> -->
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary m-3">Edit</button>
                                </form>
                                <form method="POST" action="/sellerDashboard/MyProductSellerDelete/{{$item->id}}">
                                    <!-- <a href="/sellerDashboard/MyOrderSellerDelete/{{$item->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</a> -->
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary m-3">Delete</button>
                                </form>
                            </td>
                            <!-- Add more table data here if needed -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
        <!-- </div> -->
    </section>
</body>

</html>