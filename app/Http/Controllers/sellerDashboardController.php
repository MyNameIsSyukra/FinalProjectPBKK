<?php

namespace App\Http\Controllers;

use App\Models\shop;
use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\productCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sellerDashboardController extends Controller
{
    public function index()
    {
        $shop = shop::all()->where('user_id', Auth::user()->id);
        // $shop_id = $shop->pluck('id');
        // dd($shop);
        $product = product::all();
        // dd($product);
        return view('seller.dashboardSeller', compact('shop'), compact('product'));
    }
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
    public function orderViewSeller()
    {
        $id_user = Auth::user()->id;
        $shop = shop::all()->where('user_id', $id_user);
        $id_shop = shop::all()->where('user_id', $id_user);
        $id_shopArray = $id_shop->toArray();
        // $order = order::with('product')->where('shop_id', $id_Shop)->get();

        $ordersArray = [];
        foreach ($id_shopArray as $id_shop) {
            $orders = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('orders.*', 'products.shop_id', 'products.name', 'products.price', 'products.photo')
                ->where('products.shop_id', '=', $id_shop)
                ->get();
            array_push($ordersArray, $orders);
        }
        // $orders = DB::table('orders')
        //     ->join('products', 'orders.product_id', '=', 'products.id')
        //     ->select('orders.*', 'products.*')
        //     ->where('products.shop_id', '=', $id_shop)
        //     ->get();

        // dd($ordersArray);
        return view('seller.SellerMyOrder', compact('shop'), compact('ordersArray'));
    }

    public function deleteOrder(order $order, string $id)
    {
        // $id = '0';
        // dd($id);
        $order = order::find($id);
        $order->delete();
        return redirect()->route('orderViewSeller');
    }

    public function deleteProduct(product $product, string $id)
    {
        // $id = '0';
        // dd($id);
        $product = product::find($id);
        $product->delete();
        return redirect()->route('sellerDashboard');
    }
}
