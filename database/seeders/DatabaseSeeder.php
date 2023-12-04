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

        shop::create([
            'name' => 'guci',
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
            'name' => 'supreme t-shirt',
            'description' => 'belongs to supreme',
            'price' => '10000',
            'photo' => 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2/AcfW3p5D6ov573fABLyGqwYdolD.jpg',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Appple Watch',
            'description' => 'just apple',
            'price' => '20000',
            'photo' => 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2/AcfW3p5D6ov573fABLyGqwYdolD.jpg',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Guci bag',
            'description' => 'bag',
            'price' => '10000',
            'photo' => 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2/AcfW3p5D6ov573fABLyGqwYdolD.jpg',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'LV cap',
            'description' => 'cap',
            'price' => '10000',
            'photo' => 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2/AcfW3p5D6ov573fABLyGqwYdolD.jpg',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
        product::create([
            'name' => 'Saint lorenz watch',
            'description' => 'watch',
            'price' => '10000',
            'photo' => 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2/AcfW3p5D6ov573fABLyGqwYdolD.jpg',
            'product_category_id' => 1,
            'quantity' => 15,
            'shop_id' => 1,
        ]);
    }
}
