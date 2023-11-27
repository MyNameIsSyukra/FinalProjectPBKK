<?php

namespace App\Http\Controllers;

use App\Models\cartProduct;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request){
        
        $id = $request->user()->id;
        // dd("$id");
        $cartProduct = cartProduct::create([
            'product_id' => $request->productId , 
            'user_id' => $id
        ]);
        return $cartProduct;
    }
}
