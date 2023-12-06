<?php

namespace App\Http\Controllers;

use App\Models\shop;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\productCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function deleteProduct(product $product, string $id)
    {
        // $id = '0';
        // dd($id);
        $product = product::find($id);
        $product->delete();
        return redirect()->route('sellerDashboard');
    }
    //

    public function create()
    {
        return view('seller.addproduct');
    }

    public function store(Request $request)
    {

        $shop = shop::all()->where('name', $request->shopname)->where('user_id', Auth::user()->id)->first();
        $shop_id = $shop->id;
        // dd($shop_id);
        $request->validate([
            'nama' => 'required|min:3|max:30',
            'foto' => 'required|max:2048|mimes:jpg,jpeg,png',
            'price' => 'required|numeric',
            'description' => 'required|min:3|max:100',
            'quantity' => 'required|numeric|min:1',
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
    public function IndexeditProduct(string $id)
    {
        // dd('masuk');
        $product = product::find($id);
        return view('seller.editProduct', compact('product'));
    }
    public function editProduct(Request $request, string $id)
    {
        $product = product::find($id);
        $product_category_id = productCategory::where('name', $request->product_category)->first()->id;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->product_category_id = $product_category_id;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('sellerDashboard')->with(['status' => 'success']);
    }
}
