<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\productCategory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\shop;
use App\Models\product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('syukra123'),
            'address' => 'jakarta, DKI jakart',
            'phoneNumber' => '+6285749111111',
            'role' => 1,
        ]);
        User::create([
            'name' => 'Test User',
            'email' => 'test1@example.com',
            'password' => Hash::make('syukra123'),
            'address' => 'jakarta, DKI jakart',
            'phoneNumber' => '+6285749111111',
            'role' => 1,
        ]);
        User::factory(10)->create();
        shop::create([
            'name' => 'guci',
            'email' => 'shop@email.com',
            'phone_number' => '6285749111111',
            'address' => 'Jakarta',
            'user_id' => 1,
        ]);
        shop::create([
            'name' => 'TokoMaju',
            'email' => 'shop@email.com',
            'phone_number' => '6285749111111',
            'address' => 'Jakarta',
            'user_id' => 1,
        ]);
        productCategory::create([
            'name' => 'Shirt',
        ]);
        productCategory::create([
            'name' => 'Trouser',
        ]);
        productCategory::create([
            'name' => 'Electronics',
        ]);
        productCategory::create([
            'name' => 'Furniture',
        ]);
        productCategory::create([
            'name' => 'other',
        ]);
        product::create([
            'name' => 'supreme hoodiee',
            'description' => 'belongs to supreme',
            'price' => '10000',
            'photo' => 'https://images.unsplash.com/photo-1613129636600-80409eac1d07?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c3VwcmVtZSUyMHRzaGlydHxlbnwwfHwwfHx8MA%3D%3D',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Appple Watch',
            'description' => 'just apple',
            'price' => '20000',
            'photo' => 'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8QXBwbGUlMjB3YXRjaHxlbnwwfHwwfHx8MA%3D%3D',
            'product_category_id' => 5,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Guci bag',
            'description' => 'bag',
            'price' => '10000',
            'photo' => 'https://images.unsplash.com/photo-1583623733237-4d5764a9dc82?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Z3VjY2klMjBiYWd8ZW58MHx8MHx8fDA%3D',
            'product_category_id' => 5,
            'quantity' => 15,
            'shop_id' => 2,
        ]);
        product::create([
            'name' => 'LV cap',
            'description' => 'cap',
            'price' => '10000',
            'photo' => 'https://images.unsplash.com/photo-1500964935344-6219dea133e4?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fEx2JTIwY2FwfGVufDB8fDB8fHww',
            'product_category_id' => 5,
            'quantity' => 15,
            'shop_id' => 2,
        ]);
        product::create([
            'name' => 'Saint lorenz watch',
            'description' => 'watch',
            'price' => '10000',
            'photo' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8U2FpbnQlMjBsb3JlbnolMjB3YXRjaHxlbnwwfHwwfHx8MA%3D%3D',
            'product_category_id' => 5,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Wooden Chair',
            'description' => 'Chair that soo good',
            'price' => '100000',
            'photo' => 'https://images.unsplash.com/photo-1549497538-303791108f95?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Q2hhaXJ8ZW58MHx8MHx8fDA%3D',
            'product_category_id' => 4,
            'quantity' => 15,
            'shop_id' => 2,
        ]);
        product::create([
            'name' => 'Eye Glasses',
            'description' => 'Rayban',
            'price' => '100000',
            'photo' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D',
            'product_category_id' => 5,
            'quantity' => 12,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Camer 360',
            'description' => 'Nikon Kamera',
            'price' => '100000',
            'photo' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D',
            'product_category_id' => 5,
            'quantity' => 12,
            'shop_id' => 1,
        ]);
    }
}
