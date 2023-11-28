<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\product;
use App\Models\productCategory;
use App\Models\shop;

class sellerDashboardController extends Controller
{
    public function index()
    {
        $shop = shop::all()->where('user_id', Auth::user()->id);
        // $shop_id = $shop->pluck('id');
        // dd($shop);
        $product = product::all();
        // dd($product);
        return view('dashboardSeller', compact('shop'), compact('product'));
    }
    public function create()
    {
        return view('addproduct');
    }

    public function store(Request $request)
    {

        $shop = shop::all()->where('name', $request->shopname)->where('user_id', Auth::user()->id)->first();
        $shop_id = $shop->id;
        // dd($shop_id);
        $request->validate([
            'nama' => 'required|min:3|max:30',
            'foto' => 'required|max:2048|mimes:jpg,jpeg,png'
        ]);

        $request->foto->storeAs('public/images', $request->foto->getClientOriginalName());
        $product_category_id = productCategory::where('name', $request->product_category)->first()->id;
        // dd($product_category_id);
        product::create([
            'name' => $request->nama,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $request->foto->getClientOriginalName(),
            'product_category_id' => $product_category_id,
            'quantity' => $request->quantity,
            'shop_id' => $shop_id,
        ]);
        return redirect()->route('sellerDashboard')->with(['status' => 'success']);
    }
}
