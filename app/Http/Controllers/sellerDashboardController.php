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
}
