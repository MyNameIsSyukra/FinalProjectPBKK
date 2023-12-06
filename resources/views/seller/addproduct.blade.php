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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: grey ;">
    <div class="row m-10">
        <div class="col-6 offset-3">
            <div class="container border rounded bg-gray-300">
                <div class="flex justify-center mt-3">
                    <h1 class="mx-auto text-4xl font-bold">DATA DIRI</h1>
                </div>
                <form method="POST" action="/sellerDashboard/addProduct" enctype="multipart/form-data">
                    @csrf

                    <div class="px-3 py-3 py-xl-0"></div>

                    <div class="flex items-center m-3">
                        <label for="shopname" class="pr-1 whitespace-nowrap">Toko:</label>
                        <select name="shopname" id="shopname" class="py-1">
                            @foreach (\App\Models\shop::all()->where('user_id',Auth::user()->id) as $shopname)
                            <option value="{{ $shopname->name }}" {{ request('shopname') == $shopname->name }}>
                                {{ $shopname->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="m-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control bg-gray-100" id="nama" name="nama" required>
                        @error('nama')
                        <div class="text-red-500">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="m-3">
                        <label for="description" class="form-label">Descrip</label>
                        <input type="description" class="form-control bg-gray-100" id="description" name="description" required>
                        @error('description')
                        <div class="text-red-500">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="m-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control bg-gray-100" id="price" name="price" required>
                        @error('price')
                        <div class="text-red-500">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="px-3 py-3 py-xl-0"></div>

                    <div class="flex items-center m-3">
                        <label for="product_category" class="pr-1 whitespace-nowrap">Category:</label>
                        <select name="product_category" id="product_category" class="py-1">
                            @foreach (\App\Models\productCategory::all() as $product_category)
                            <option value="{{ $product_category->name }}" {{ request('product_category') == $product_category->name }}>
                                {{ $product_category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="m-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control bg-gray-100" id="foto" name="foto" required>
                        @error('foto')
                        <div class="text-red-500">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="m-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control bg-gray-100" id="quantity" name="quantity" required>
                        @error('quantity')
                        <div class="text-red-500">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary m-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>