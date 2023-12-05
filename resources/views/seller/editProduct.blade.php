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

<body style="height: 100vh;">

    <div style="border: 5px solid;
  margin: auto;
  width: 50%;
  padding: 10px;">
        <form action="/sellerDashbord/MyProductSellerEdit/{{$product->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ $product->description }}</textarea>
            </div>
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

            <div>
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="{{ $product->price }}">
            </div>

            <div>
                <label for="quantity">quantity</label>
                <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}">
            </div>

            <div>
                <label for="image">Image</label>
                <input id="photo" type="file" name="image">
            </div>
            <div>
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</body>

</html>