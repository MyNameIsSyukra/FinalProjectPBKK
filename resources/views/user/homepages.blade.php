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
                        <a href="{{ route('homepages') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('homepages')" :active="request()->routeIs('homepages')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                </div>
                <div class="flex items-center">
                    <form method="GET" action="{{ route('homepages') }}" class="flex">

                        <input type="search" name="search" id="search" class="py-1 form-control" placeholder="search" style="flex-basis: fit-content" value="{{ request('search') }}">

                        <div class="px-3 py-3 py-xl-0"></div>

                        <div class="d-flex align-items-center">
                            <label for="genre" class="pr-1 text-nowrap">Category:</label>
                            <select name="genre" id="genre" class="py-1">
                                <option value="all" {{ request('genre') == 'all' }} default>All Genre</option>
                                @foreach (\App\Models\productCategory::all() as $genre)
                                <option value="{{ $genre->name }}" {{ request('genre') == $genre->name }}>
                                    {{ $genre->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

                <div>
                    <ul class="mt-4 font-medium flex flex-col p-4 md:p-0 md:flex-row md:space-x-8 rtl:space-x-reverse ">
                        @if (Auth::user() != Null)

                        @if (Auth::user()->role == 1)
                        <li>
                            <a href="{{ route('sellerDashboard') }}" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Seller Dashboard</a>
                        </li>
                        <li>
                            <a href="/sellerDashboard/MyOrderSeller" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" aria-current="page">My Order</a>
                        </li>
                        @endif

                        @endif

                        @if (Auth::user()->role == 0)
                        <li>
                            <a href="/homepages/MyCart" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">Cart</a>
                            <a href="/homepages/MyOrder" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">My Order</a>
                        </li>
                        <li>
                            <a href="/homepages/MyOrder" class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">MyOrder</a>
                        </li>
                        @endif
                        <li>
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero -->
    <section class=" items-center" style="background: url({{ asset('9579708.jpg') }});
            background-size: cover;
            height: 125vh">

        <div class="p-20 grid grid-cols-1 md:grid-cols-2">
            <div class="flex flex-col justify-center text-center">
                <h1>Mau Belanja??</h1>
                <h2>E-Commerce-in Ajaa!!</h2>
                <p>Belanja barang-barang kebutuhanmu dengan mudah dan cepat</p>
            </div>
            <div class="container flex align-middle items-center">
                <svg transform="scale(0.6)" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="879.12502" height="631.48453" viewBox="0 0 879.12502 631.48453" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect id="b93b1ef9-49b5-4354-905b-d9dddde45a10" data-name="Rectangle 338" x="0.27499" y="0.36501" width="644.72498" height="412.91" fill="#e6e6e6" />
                    <rect id="ef7485f9-8ecd-46d9-949e-abdd8aa9e360" data-name="Rectangle 339" x="18.711" y="52.15401" width="607.85303" height="336.69299" fill="#fff" />
                    <rect id="b4c2a7ec-beab-40bc-b587-23a202562f78" data-name="Rectangle 340" width="644.72498" height="27.39" fill="#6c63ff" />
                    <circle id="bd6d3ebf-cb6f-4fcb-b7cd-ad5a287d3324" data-name="Ellipse 513" cx="20.355" cy="14.004" r="5.077" fill="#fff" />
                    <circle id="efb1158e-7a7d-4adb-9063-fc7dc50c76d5" data-name="Ellipse 514" cx="39.624" cy="14.004" r="5.077" fill="#fff" />
                    <circle id="b51f9e19-f36b-4f29-afd5-008bb0fc20dd" data-name="Ellipse 515" cx="58.89299" cy="14.004" r="5.077" fill="#fff" />
                    <rect id="b636d421-4358-445b-b124-1d058e78c733" data-name="Rectangle 341" x="93.5" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <rect id="ab9c902d-64a9-4a2b-a9ec-6dc7022c80f6" data-name="Rectangle 342" x="263.19299" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <rect id="f4a232af-026e-479b-8040-5c62e5965d9e" data-name="Rectangle 343" x="432.88501" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <rect id="ada16aa4-f84d-4851-87ee-a2852d96226a" data-name="Rectangle 344" x="93.5" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <rect id="ebfcbe07-3b81-4d69-a4f5-6a8318d20e8d" data-name="Rectangle 345" x="263.19299" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <rect id="ead16b6d-d132-49a9-a42f-1f570e523a46" data-name="Rectangle 346" x="432.88501" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6" />
                    <path id="ab8ff6e3-f37e-4992-8347-ee905fdba816-204" data-name="Path 2643" d="M452.3655,399.58275l21.722-8.588,2.526,42.939s4.546,13.134,3.031,18.186c0,0,1.01,8.588-1.516,9.093s-9.6,1.516-10.1,1.01-.505-2.021-.505-2.021-5.052,3.536-5.557,7.577c0,0-21.217,6.567-21.722.505s10.608-11.114,10.608-11.114l8.588-13.134Z" transform="translate(-160.43749 -134.25774)" fill="#fff" />
                    <path id="e647835b-1773-4993-9de9-376235a5ef39-205" data-name="Path 2644" d="M498.33749,399.58275l21.719-8.588,2.526,42.939s4.546,13.134,3.031,18.186c0,0,1.01,8.588-1.516,9.093s-9.6,1.516-10.1,1.01-.505-2.021-.505-2.021-5.052,3.536-5.557,7.577c0,0-21.217,6.567-21.722.505s10.608-11.114,10.608-11.114l8.588-13.134Z" transform="translate(-160.43749 -134.25774)" fill="#fff" />
                    <path id="ee50e840-b8e9-4cc0-9b2e-64e12816c6e5-206" data-name="Path 2645" d="M500.4595,233.76773s-4.625,12.924.734,18.752l-4.468,15.353s15.874,47.622,11.339,54.274c0,0-16.932,8.466-50.8-3.024l13.757-53.367-1.965-22.526,2.721-10.583,6.047-.6s-3.628,13.606,3.024,15.723,13.141-15.383,13.141-15.383Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                    <path id="b668efb4-5504-4326-941b-9be143c4d030-207" data-name="Path 2646" d="M286.85848,317.19475l5.837,2.388,27.858-36.613,8.755,42.98,5.837-1.061c3.744-37.055,6.8-74.85,3.051-92.726l-21.623-.929-9.816,31.311-4.776,21.225Z" transform="translate(-160.43749 -134.25774)" fill="#fff" />
                    <path id="b699d661-049e-451c-8a7e-64343ac1c335-208" data-name="Path 2647" d="M641.11547,231.86974s-7.966,11.074-7.577,15.543,5.44,77.327,5.44,77.327l11.852.583-3.5-52.458,2.914-14.183,7.189,66.058,14.572.389-13.017-85.681-2.526-7.577Z" transform="translate(-160.43749 -134.25774)" fill="#fff" />
                    <path id="a4f25674-ecb7-42aa-ae9a-d508200b11eb-209" data-name="Path 2648" d="M686.1375,410.27574c-2.115-2.538-5.751-3.91-9.242-4.652.1-.317-10.618-2.532-10.8-2.076l-4.041-3.219-12.417,6.447-6.977-4.75-3.241,1.15c.132-.572-10.061,1.194-10.061,1.194-1.947.07-4.434.192-7.218.406-9.749.75-10.5,26-10.5,26a39.85013,39.85013,0,0,1,14.113-2.955l2.635,30.2c13.553-1.162,27.767.19,42.5,3.5l6.909-23.74,16.089-6.257S691.1375,416.27474,686.1375,410.27574Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                    <path id="b6d7fb25-d94e-4ba0-9382-3f72a4c565e4-210" data-name="Path 2649" d="M340.8785,395.89473c-1.743-2.091-4.738-3.222-7.615-3.833.086-.262-8.749-2.086-8.9-1.71l-3.33-2.652-10.229,5.312-5.749-3.913-2.67.948c.109-.471-8.29.983-8.29.983-1.6.058-3.654.158-5.947.335-8.033.618-8.651,21.421-8.651,21.421a32.837,32.837,0,0,1,11.629-2.435l2.171,60.914c11.167-.958,22.879.157,35.015,2.884l5.692-55.59,13.257-5.155S344.99749,400.83974,340.8785,395.89473Z" transform="translate(-160.43749 -134.25774)" fill="#fff" />
                    <path id="abb48a01-b3b6-4bc9-9e6f-5cc93133d8eb-211" data-name="Path 2682" d="M909.8875,412.10872h57v-30.5a28.5,28.5,0,1,0-57,0Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41" />
                    <path id="f1b40e10-dbea-4491-93e9-bf21ee1afe95-212" data-name="Path 2683" d="M884.4425,751.45272h-12.259l-5.833-47.292h18.094Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6" />
                    <path id="f19e2682-d3fb-40a9-8809-be7b68a78ac9-213" data-name="Path 2684" d="M887.56951,747.44972h-24.145a15.387,15.387,0,0,0-15.386,15.385v.5h39.531Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41" />
                    <path id="b3618d44-3857-42e4-aed2-10e127155f21-214" data-name="Path 2685" d="M1030.99651,735.09173l-10.676,6.027-28.328-38.311,15.757-8.895Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6" />
                    <path id="a172411a-a77d-4e4f-ac70-c8342021cfb1-215" data-name="Path 2686" d="M1031.7515,730.06874l-21.025,11.866h0a15.387,15.387,0,0,0-5.834,20.963l.246.435,34.424-19.433Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41" />
                    <path id="bd1532c7-07e2-44c0-82ff-fc8e0d37942d-216" data-name="Path 2687" d="M952.64249,538.78172l.946,4.73s2.838,2.838,1.419,4.257-.946,8.042-.946,8.042c.794,12.076,16.573,79.936,19.395,93.189,0,0,21.76,14.191,38.789,42.1s17.5,35.005,17.5,35.005l-18.918,8.043-47.3-57.238s-13.245-8.042-17.976-15.137-34.064-80.418-34.064-80.418l-16.56,76.63306s.946,27.909-3.311,45.885a192.52229,192.52229,0,0,0-4.73,34.532l-22.233-2.365s1.419-67.172,3.784-74.268c0,0-9.934-81.836,9.934-114.476l16.012-42.687,15.682-6.036Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41" />
                    <path id="e2a54528-859f-4f0e-9aca-6130773a8d3b-217" data-name="Path 2688" d="M938.68153,360.56471c-29.847.51-29.842,44.907,0,45.412C968.52653,405.46672,968.5225,361.06972,938.68153,360.56471Z" transform="translate(-160.43749 -134.25774)" fill="#ffb8b8" />
                    <path id="aeace49c-5333-476f-965d-52da8fac2318-218" data-name="Path 2689" d="M915.71052,382.09273h5.073l1.381-3.454-.691,3.454h27.745l-.9-7.227,6.744,7.227h6.727v-3.916a23.038,23.038,0,1,0-46.076-.03259v.03259Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41" />
                    <path id="aa5a3aa9-e50b-4b43-b42d-0c1415925835-219" data-name="Path 2690" d="M907.9035,419.23473l56.4.457-11.916,120.917s-65.959-3.481-66-23.614l6.179-17.891Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                    <path id="aca4d347-909c-4b66-b72e-6bb1477aee43-220" data-name="Path 2693" d="M966.7275,552.29772a9.377,9.377,0,0,1,2.7-14.122l-2.451-21.287,12.573-4.645,3.039,30.111a9.428,9.428,0,0,1-15.861,9.943Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6" />
                    <path id="eab38d24-ad2d-4cbe-aaaa-db975580c866-221" data-name="Path 2694" d="M956.8875,430.10872l7.421-10.373s5.079-1.127,11.079,5.873,9.5,94.5,9.5,94.5l-22,5-13-62Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                    <polygon points="672.135 390.739 673.771 468.476 724.096 495.071 815.744 478.705 817.995 397.899 759.896 377.441 672.135 390.739" fill="#fff" />
                    <path d="M884.40233,630.16805,833.4151,603.22344l-1.66142-78.9158,88.65793-13.43306.18894.06631L979.252,531.593l-2.28476,82.04559ZM835.002,602.244l49.66249,26.24458,90.73236-16.20225,2.2157-79.56639L920.256,512.52345,833.39038,525.685Z" transform="translate(-160.43749 -134.25774)" fill="#cacaca" />
                    <polygon points="722.973 411.816 722.776 411.738 671.838 391.485 672.431 389.992 723.173 410.166 817.885 397.103 818.105 398.695 722.973 411.816" fill="#cacaca" />
                    <rect x="883.2183" y="545.24581" width="1.60739" height="84.08562" transform="translate(-167.5157 -123.4613) rotate(-0.69695)" fill="#cacaca" />
                    <polygon points="716.536 407.792 698.174 400.348 786.569 386.263 804.931 393.706 716.536 407.792" fill="#cacaca" />
                    <rect x="842.41659" y="541.27671" width="1.60727" height="23.18645" transform="translate(-158.47692 974.46083) rotate(-66.70554)" fill="#cacaca" />
                    <rect x="852.06024" y="567.79675" width="1.60727" height="23.18645" transform="translate(-177.00517 999.35088) rotate(-66.70554)" fill="#6c63ff" />
                    <polygon points="392.135 498.739 393.771 576.476 444.096 603.071 535.744 586.705 537.995 505.899 479.896 485.441 392.135 498.739" fill="#fff" />
                    <path d="M604.40233,738.16805,553.4151,711.22344l-1.66142-78.9158,88.65793-13.43306.18894.06631L699.252,639.593l-2.28476,82.04559ZM555.002,710.244l49.66249,26.24458,90.73236-16.20225,2.2157-79.56639L640.256,620.52345,553.39038,633.685Z" transform="translate(-160.43749 -134.25774)" fill="#cacaca" />
                    <polygon points="442.973 519.816 442.776 519.738 391.838 499.485 392.431 497.992 443.173 518.166 537.885 505.103 538.105 506.695 442.973 519.816" fill="#cacaca" />
                    <rect x="603.2183" y="653.24581" width="1.60739" height="84.08562" transform="translate(-168.8501 -126.85915) rotate(-0.69695)" fill="#cacaca" />
                    <polygon points="432.088 513.962 418.174 508.348 506.569 494.263 520.482 499.877 432.088 513.962" fill="#cacaca" />
                    <rect x="562.41659" y="649.27671" width="1.60727" height="23.18645" transform="translate(-426.94537 782.57581) rotate(-66.70554)" fill="#cacaca" />
                    <rect x="572.06024" y="675.79675" width="1.60727" height="23.18645" transform="translate(-445.47361 807.46587) rotate(-66.70554)" fill="#6c63ff" />
                    <polygon points="479.563 509.397 481.463 599.638 539.882 630.51 646.271 611.512 648.883 517.709 581.44 493.961 479.563 509.397" fill="#6c63ff" />
                    <path d="M700.16688,765.74226l-59.18795-31.27835-1.92864-91.60849,102.91755-15.59363.21933.077L810.272,651.3125l-2.65223,95.24168ZM642.821,733.327l57.65013,30.46571,105.32563-18.80819,2.57206-92.36374-66.58163-23.44486-100.837,15.2784Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                    <polygon points="538.578 533.865 538.35 533.774 479.218 510.264 479.907 508.53 538.81 531.949 648.755 516.785 649.01 518.633 538.578 533.865" fill="#3f3d56" />
                    <rect x="698.79241" y="667.16124" width="1.86593" height="97.60983" transform="translate(-169.09453 -125.69351) rotate(-0.69695)" fill="#3f3d56" />
                    <polygon points="526.888 527.112 509.79 520.553 612.402 504.202 629.501 510.761 526.888 527.112" fill="#3f3d56" />
                    <rect x="651.42821" y="662.55376" width="1.86578" height="26.91572" transform="translate(-386.96327 873.60414) rotate(-66.70554)" fill="#3f3d56" />
                    <rect x="662.62293" y="693.33925" width="1.86578" height="26.91572" transform="translate(-408.47156 902.49747) rotate(-66.70554)" fill="#fff" />
                    <path id="af1e2e82-f248-43bd-a869-489ddf745161-222" data-name="Path 2691" d="M861.10549,537.85072a9.377,9.377,0,0,0,3.673-13.9l11.422-18.13-9.324-9.628-15.771,25.829a9.428,9.428,0,0,0,10,15.83Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6" />
                    <path id="ed6195a6-5e50-4e12-83 80-54bfefa6b2ae-223" data-name="Path 2692" d="M916.57052,424.00072l-8.183-5.392s-6.315,1.416-13.031,14.334-33.8,70.672-33.8,70.672l11.133,11.3,29.7-45.309Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56" />
                </svg>
            </div>
        </div>
    </section>
    <!-- adds card sec -->
    <section class=" items-center" style="background-color: #b7aeff;">
        <div class=" p-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($data as $item )
            <div class="max-w-sm flex-col text-center rounded overflow-hidden shadow-lg">
                <a href="/homepages/detail/{{$item->id}}">
                    <img class="p-8 rounded-t-lg w-full h-100" src="{{$item->photo}}" alt="product image" />
                    <!-- <h1>BJIRRRR</h1> -->
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$item->name}}</h5>
                    </a>
                    <div class="flex-col items-center mt-2.5 mb-5">
                        <div class="space-x-1 rtl:space-x-reverse">
                            {{$item->description}}
                        </div>
                        <!-- <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span> -->
                    </div>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$item->price}}</span>
                    <div class=" flex-col items-center justify-between mt-7">
                        <a href="/homepages/addToCart/{{$item->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                        <a href="/homepages/orderNow/{{$item->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Order Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin: auto; width: 30%;padding: 10px;">
            {{$data->links()}}
        </div>
    </section>
</body>

</html>




<!-- <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="879.12502" height="631.48453" viewBox="0 0 879.12502 631.48453" xmlns:xlink="http://www.w3.org/1999/xlink"><rect id="b93b1ef9-49b5-4354-905b-d9dddde45a10" data-name="Rectangle 338" x="0.27499" y="0.36501" width="644.72498" height="412.91" fill="#e6e6e6"/><rect id="ef7485f9-8ecd-46d9-949e-abdd8aa9e360" data-name="Rectangle 339" x="18.711" y="52.15401" width="607.85303" height="336.69299" fill="#fff"/><rect id="b4c2a7ec-beab-40bc-b587-23a202562f78" data-name="Rectangle 340" width="644.72498" height="27.39" fill="#6c63ff"/><circle id="bd6d3ebf-cb6f-4fcb-b7cd-ad5a287d3324" data-name="Ellipse 513" cx="20.355" cy="14.004" r="5.077" fill="#fff"/><circle id="efb1158e-7a7d-4adb-9063-fc7dc50c76d5" data-name="Ellipse 514" cx="39.624" cy="14.004" r="5.077" fill="#fff"/><circle id="b51f9e19-f36b-4f29-afd5-008bb0fc20dd" data-name="Ellipse 515" cx="58.89299" cy="14.004" r="5.077" fill="#fff"/><rect id="b636d421-4358-445b-b124-1d058e78c733" data-name="Rectangle 341" x="93.5" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6"/><rect id="ab9c902d-64a9-4a2b-a9ec-6dc7022c80f6" data-name="Rectangle 342" x="263.19299" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6"/><rect id="f4a232af-026e-479b-8040-5c62e5965d9e" data-name="Rectangle 343" x="432.88501" y="79.84801" width="118.887" height="128.98199" fill="#e6e6e6"/><rect id="ada16aa4-f84d-4851-87ee-a2852d96226a" data-name="Rectangle 344" x="93.5" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6"/><rect id="ebfcbe07-3b81-4d69-a4f5-6a8318d20e8d" data-name="Rectangle 345" x="263.19299" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6"/><rect id="ead16b6d-d132-49a9-a42f-1f570e523a46" data-name="Rectangle 346" x="432.88501" y="232.17599" width="118.887" height="128.98199" fill="#e6e6e6"/><path id="ab8ff6e3-f37e-4992-8347-ee905fdba816-204" data-name="Path 2643" d="M452.3655,399.58275l21.722-8.588,2.526,42.939s4.546,13.134,3.031,18.186c0,0,1.01,8.588-1.516,9.093s-9.6,1.516-10.1,1.01-.505-2.021-.505-2.021-5.052,3.536-5.557,7.577c0,0-21.217,6.567-21.722.505s10.608-11.114,10.608-11.114l8.588-13.134Z" transform="translate(-160.43749 -134.25774)" fill="#fff"/><path id="e647835b-1773-4993-9de9-376235a5ef39-205" data-name="Path 2644" d="M498.33749,399.58275l21.719-8.588,2.526,42.939s4.546,13.134,3.031,18.186c0,0,1.01,8.588-1.516,9.093s-9.6,1.516-10.1,1.01-.505-2.021-.505-2.021-5.052,3.536-5.557,7.577c0,0-21.217,6.567-21.722.505s10.608-11.114,10.608-11.114l8.588-13.134Z" transform="translate(-160.43749 -134.25774)" fill="#fff"/><path id="ee50e840-b8e9-4cc0-9b2e-64e12816c6e5-206" data-name="Path 2645" d="M500.4595,233.76773s-4.625,12.924.734,18.752l-4.468,15.353s15.874,47.622,11.339,54.274c0,0-16.932,8.466-50.8-3.024l13.757-53.367-1.965-22.526,2.721-10.583,6.047-.6s-3.628,13.606,3.024,15.723,13.141-15.383,13.141-15.383Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/><path id="b668efb4-5504-4326-941b-9be143c4d030-207" data-name="Path 2646" d="M286.85848,317.19475l5.837,2.388,27.858-36.613,8.755,42.98,5.837-1.061c3.744-37.055,6.8-74.85,3.051-92.726l-21.623-.929-9.816,31.311-4.776,21.225Z" transform="translate(-160.43749 -134.25774)" fill="#fff"/><path id="b699d661-049e-451c-8a7e-64343ac1c335-208" data-name="Path 2647" d="M641.11547,231.86974s-7.966,11.074-7.577,15.543,5.44,77.327,5.44,77.327l11.852.583-3.5-52.458,2.914-14.183,7.189,66.058,14.572.389-13.017-85.681-2.526-7.577Z" transform="translate(-160.43749 -134.25774)" fill="#fff"/><path id="a4f25674-ecb7-42aa-ae9a-d508200b11eb-209" data-name="Path 2648" d="M686.1375,410.27574c-2.115-2.538-5.751-3.91-9.242-4.652.1-.317-10.618-2.532-10.8-2.076l-4.041-3.219-12.417,6.447-6.977-4.75-3.241,1.15c.132-.572-10.061,1.194-10.061,1.194-1.947.07-4.434.192-7.218.406-9.749.75-10.5,26-10.5,26a39.85013,39.85013,0,0,1,14.113-2.955l2.635,30.2c13.553-1.162,27.767.19,42.5,3.5l6.909-23.74,16.089-6.257S691.1375,416.27474,686.1375,410.27574Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/><path id="b6d7fb25-d94e-4ba0-9382-3f72a4c565e4-210" data-name="Path 2649" d="M340.8785,395.89473c-1.743-2.091-4.738-3.222-7.615-3.833.086-.262-8.749-2.086-8.9-1.71l-3.33-2.652-10.229,5.312-5.749-3.913-2.67.948c.109-.471-8.29.983-8.29.983-1.6.058-3.654.158-5.947.335-8.033.618-8.651,21.421-8.651,21.421a32.837,32.837,0,0,1,11.629-2.435l2.171,60.914c11.167-.958,22.879.157,35.015,2.884l5.692-55.59,13.257-5.155S344.99749,400.83974,340.8785,395.89473Z" transform="translate(-160.43749 -134.25774)" fill="#fff"/><path id="abb48a01-b3b6-4bc9-9e6f-5cc93133d8eb-211" data-name="Path 2682" d="M909.8875,412.10872h57v-30.5a28.5,28.5,0,1,0-57,0Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41"/><path id="f1b40e10-dbea-4491-93e9-bf21ee1afe95-212" data-name="Path 2683" d="M884.4425,751.45272h-12.259l-5.833-47.292h18.094Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6"/><path id="f19e2682-d3fb-40a9-8809-be7b68a78ac9-213" data-name="Path 2684" d="M887.56951,747.44972h-24.145a15.387,15.387,0,0,0-15.386,15.385v.5h39.531Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41"/><path id="b3618d44-3857-42e4-aed2-10e127155f21-214" data-name="Path 2685" d="M1030.99651,735.09173l-10.676,6.027-28.328-38.311,15.757-8.895Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6"/><path id="a172411a-a77d-4e4f-ac70-c8342021cfb1-215" data-name="Path 2686" d="M1031.7515,730.06874l-21.025,11.866h0a15.387,15.387,0,0,0-5.834,20.963l.246.435,34.424-19.433Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41"/><path id="bd1532c7-07e2-44c0-82ff-fc8e0d37942d-216" data-name="Path 2687" d="M952.64249,538.78172l.946,4.73s2.838,2.838,1.419,4.257-.946,8.042-.946,8.042c.794,12.076,16.573,79.936,19.395,93.189,0,0,21.76,14.191,38.789,42.1s17.5,35.005,17.5,35.005l-18.918,8.043-47.3-57.238s-13.245-8.042-17.976-15.137-34.064-80.418-34.064-80.418l-16.56,76.63306s.946,27.909-3.311,45.885a192.52229,192.52229,0,0,0-4.73,34.532l-22.233-2.365s1.419-67.172,3.784-74.268c0,0-9.934-81.836,9.934-114.476l16.012-42.687,15.682-6.036Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41"/><path id="e2a54528-859f-4f0e-9aca-6130773a8d3b-217" data-name="Path 2688" d="M938.68153,360.56471c-29.847.51-29.842,44.907,0,45.412C968.52653,405.46672,968.5225,361.06972,938.68153,360.56471Z" transform="translate(-160.43749 -134.25774)" fill="#ffb8b8"/><path id="aeace49c-5333-476f-965d-52da8fac2318-218" data-name="Path 2689" d="M915.71052,382.09273h5.073l1.381-3.454-.691,3.454h27.745l-.9-7.227,6.744,7.227h6.727v-3.916a23.038,23.038,0,1,0-46.076-.03259v.03259Z" transform="translate(-160.43749 -134.25774)" fill="#2f2e41"/><path id="aa5a3aa9-e50b-4b43-b42d-0c1415925835-219" data-name="Path 2690" d="M907.9035,419.23473l56.4.457-11.916,120.917s-65.959-3.481-66-23.614l6.179-17.891Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/><path id="aca4d347-909c-4b66-b72e-6bb1477aee43-220" data-name="Path 2693" d="M966.7275,552.29772a9.377,9.377,0,0,1,2.7-14.122l-2.451-21.287,12.573-4.645,3.039,30.111a9.428,9.428,0,0,1-15.861,9.943Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6"/><path id="eab38d24-ad2d-4cbe-aaaa-db975580c866-221" data-name="Path 2694" d="M956.8875,430.10872l7.421-10.373s5.079-1.127,11.079,5.873,9.5,94.5,9.5,94.5l-22,5-13-62Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/><polygon points="672.135 390.739 673.771 468.476 724.096 495.071 815.744 478.705 817.995 397.899 759.896 377.441 672.135 390.739" fill="#fff"/><path d="M884.40233,630.16805,833.4151,603.22344l-1.66142-78.9158,88.65793-13.43306.18894.06631L979.252,531.593l-2.28476,82.04559ZM835.002,602.244l49.66249,26.24458,90.73236-16.20225,2.2157-79.56639L920.256,512.52345,833.39038,525.685Z" transform="translate(-160.43749 -134.25774)" fill="#cacaca"/><polygon points="722.973 411.816 722.776 411.738 671.838 391.485 672.431 389.992 723.173 410.166 817.885 397.103 818.105 398.695 722.973 411.816" fill="#cacaca"/><rect x="883.2183" y="545.24581" width="1.60739" height="84.08562" transform="translate(-167.5157 -123.4613) rotate(-0.69695)" fill="#cacaca"/><polygon points="716.536 407.792 698.174 400.348 786.569 386.263 804.931 393.706 716.536 407.792" fill="#cacaca"/><rect x="842.41659" y="541.27671" width="1.60727" height="23.18645" transform="translate(-158.47692 974.46083) rotate(-66.70554)" fill="#cacaca"/><rect x="852.06024" y="567.79675" width="1.60727" height="23.18645" transform="translate(-177.00517 999.35088) rotate(-66.70554)" fill="#6c63ff"/><polygon points="392.135 498.739 393.771 576.476 444.096 603.071 535.744 586.705 537.995 505.899 479.896 485.441 392.135 498.739" fill="#fff"/><path d="M604.40233,738.16805,553.4151,711.22344l-1.66142-78.9158,88.65793-13.43306.18894.06631L699.252,639.593l-2.28476,82.04559ZM555.002,710.244l49.66249,26.24458,90.73236-16.20225,2.2157-79.56639L640.256,620.52345,553.39038,633.685Z" transform="translate(-160.43749 -134.25774)" fill="#cacaca"/><polygon points="442.973 519.816 442.776 519.738 391.838 499.485 392.431 497.992 443.173 518.166 537.885 505.103 538.105 506.695 442.973 519.816" fill="#cacaca"/><rect x="603.2183" y="653.24581" width="1.60739" height="84.08562" transform="translate(-168.8501 -126.85915) rotate(-0.69695)" fill="#cacaca"/><polygon points="432.088 513.962 418.174 508.348 506.569 494.263 520.482 499.877 432.088 513.962" fill="#cacaca"/><rect x="562.41659" y="649.27671" width="1.60727" height="23.18645" transform="translate(-426.94537 782.57581) rotate(-66.70554)" fill="#cacaca"/><rect x="572.06024" y="675.79675" width="1.60727" height="23.18645" transform="translate(-445.47361 807.46587) rotate(-66.70554)" fill="#6c63ff"/><polygon points="479.563 509.397 481.463 599.638 539.882 630.51 646.271 611.512 648.883 517.709 581.44 493.961 479.563 509.397" fill="#6c63ff"/><path d="M700.16688,765.74226l-59.18795-31.27835-1.92864-91.60849,102.91755-15.59363.21933.077L810.272,651.3125l-2.65223,95.24168ZM642.821,733.327l57.65013,30.46571,105.32563-18.80819,2.57206-92.36374-66.58163-23.44486-100.837,15.2784Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/><polygon points="538.578 533.865 538.35 533.774 479.218 510.264 479.907 508.53 538.81 531.949 648.755 516.785 649.01 518.633 538.578 533.865" fill="#3f3d56"/><rect x="698.79241" y="667.16124" width="1.86593" height="97.60983" transform="translate(-169.09453 -125.69351) rotate(-0.69695)" fill="#3f3d56"/><polygon points="526.888 527.112 509.79 520.553 612.402 504.202 629.501 510.761 526.888 527.112" fill="#3f3d56"/><rect x="651.42821" y="662.55376" width="1.86578" height="26.91572" transform="translate(-386.96327 873.60414) rotate(-66.70554)" fill="#3f3d56"/><rect x="662.62293" y="693.33925" width="1.86578" height="26.91572" transform="translate(-408.47156 902.49747) rotate(-66.70554)" fill="#fff"/><path id="af1e2e82-f248-43bd-a869-489ddf745161-222" data-name="Path 2691" d="M861.10549,537.85072a9.377,9.377,0,0,0,3.673-13.9l11.422-18.13-9.324-9.628-15.771,25.829a9.428,9.428,0,0,0,10,15.83Z" transform="translate(-160.43749 -134.25774)" fill="#ffb6b6"/><path id="ed6195a6-5e50-4e12-8380-54bfefa6b2ae-223" data-name="Path 2692" d="M916.57052,424.00072l-8.183-5.392s-6.315,1.416-13.031,14.334-33.8,70.672-33.8,70.672l11.133,11.3,29.7-45.309Z" transform="translate(-160.43749 -134.25774)" fill="#3f3d56"/></svg> -->