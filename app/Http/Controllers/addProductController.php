<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class addProductController extends Controller
{
    public function index()
    {
        return view('addproduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:30',
            'foto' => 'required|max:2048|mimes:jpg,jpeg,png'
        ]);

        $request->foto->storeAs('public/images', $request->foto->getClientOriginalName());

        product::create([
            'name' => $request->nama,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $request->foto->getClientOriginalName(),
            'product_category_id' => $request->product_category_id,
            'quantity' => $request->quantity,
            'shop_id' => $request->shop_id
        ]);
        return redirect('/homepages')->with(['status' => 'success']);
    }
}
