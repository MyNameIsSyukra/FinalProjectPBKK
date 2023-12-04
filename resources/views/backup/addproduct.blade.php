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

<body style="background-color:  #d0e7d2 ;">
    <div class="row" style="margin: 10vh;">
        <div class="col-6 offset-3">
            <div class="container border rounded" style="background-color:cadetblue;">
                <div class="d-flex justify-content-center mt-3">
                    <h1 class="mx-auto">DATA DIRI</h1>
                </div>
                <form method="POST" action="/sellerDashboard/addProduct" enctype="multipart/form-data">
                    @csrf
                    <!-- <input type="shop" name="shop" id="shop" class="py-1 form-control" placeholder="shop" style="flex-basis: fit-content" value="{{ request('shop') }}"> -->
                    <div class="px-3 py-3 py-xl-0"></div>

                    <div class="d-flex align-items-center m-3">
                        <label for="shopname" class="pr-1 text-nowrap">Toko:</label>
                        <select name="shopname" id="shopname" class="py-1">
                            @foreach (\App\Models\shop::all()->where('user_id',Auth::user()->id) as $shopname)
                            <option value="{{ $shopname->name }}" {{ request('shopname') == $shopname->name }}>
                                {{ $shopname->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama --}}
                    <div class="m-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        @error('nama')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    {{-- Desc --}}
                    <div class="m-3">
                        <label for="description" class="form-label">Descrip</label>
                        <input type="description" class="form-control" id="description" name="description" required>
                        @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="m-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                        @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <!-- {{-- Category --}}
                    <div class="m-3">
                        <label for="product_category_id" class="form-label">Category</label>
                        <input type="text" class="form-control" id="product_category_id" name="product_category_id" required>
                        @error('product_category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div> -->

                    <div class="px-3 py-3 py-xl-0"></div>

                    <div class="d-flex align-items-center m-3">
                        <label for="product_category" class="pr-1 text-nowrap">Category:</label>
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
                        <input type="file" class="form-control" id="foto" name="foto" required>
                        @error('foto')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    {{-- quantity --}}
                    <div class="m-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" required>
                        @error('quantity')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    {{-- Tombol Submit --}}
                    <button type="submit" class="btn btn-primary m-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>