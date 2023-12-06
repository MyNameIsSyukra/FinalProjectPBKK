<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cartProduct;
use App\Models\order;
use App\Models\orderDetails;

class homepageController extends Controller
{
    public function index(Request $request)
    {
        $data = product::query()->with('productCategory');
        // $out->writeln($moviesQuery->toSql());
        // dd($request->input('genre'));

        if ($request->has('search')) {
            $search = $request->input('search');
            $data->where('name', 'like', '%' . $search . '%');
        } else {
            $data->orderByDesc('created_at');
        }
        if ($request->has('genre')) {
            if ($request->input('genre') == 'all') {
                $data->where('product_category_id', '!=', null);
            } else {
                $productCategory = productCategory::where('name', $request->input('genre'))->first();
                $data->where('product_category_id', $productCategory->id);
                // dd($data);
            }
        }
        $data = $data->paginate(3);
        if (Auth::user() != Null) {
            return view('user.homepages', compact('data'));
        } else
            return view('homepage', compact('data'));
    }
    public function detail(product $product)
    {
        return view('detailProduct', compact('product'));
    }

    public function addToCart(Request $request)
    {

        $id = $request->user()->id;
        // dd("$id");
        $cartProduct = cartProduct::create([
            'product_id' => $request->productId,
            'user_id' => $id
        ]);
        return redirect('/homepages/MyCart');
    }

    public function orderView(Request $request)
    {
        $id = $request->productId;
        // dd($id);
        return view('user.OrderNow', compact('id'));
    }

    public function orderNow(Request $request, string $productId)
    {
        $id = $request->user()->id;
        $amount = product::where('id', $request->productId)->first();

        $request->screenshot->storeAs('public/images/screenshot', $request->screenshot->getClientOriginalName());
        order::create([
            'product_id' => $request->productId,
            'user_id' => $id,
            'amount' => $amount->price,
            'quantity' => $request->quantity,
            'total' => $amount->price * $request->quantity,
            'status_payment' => $request->Status_Payment,
            'screenshot' => $request->screenshot->getClientOriginalName(),
        ]);

        // dd($productId);
        // orderDetails::create([
        //     'product_id' => $productId,
        //     'user_id' => $id,
        //     'quantity' => $request->quantity,
        // ]);

        // dd($request->Status_Payment);

        return redirect('/homepages/MyOrder');
    }

    public function MyOrder(Request $request)
    {
        $id = $request->user()->id;
        $data = order::where('user_id', $id)->get();
        // $data = [];
        // foreach ($order as $order) {
        //     $product = product::where('id', $order->product_id)->first();
        //     array_push($data, $product);
        // }
        // dd($order);
        return view('user.MyOrder', compact('data'));
    }

    public function cart(Request $request)
    {
        $id = $request->user()->id;
        $cartProduct = cartProduct::where('user_id', $id)->get();
        $data = [];
        foreach ($cartProduct as $cart) {
            $product = product::where('id', $cart->product_id)->first();
            array_push($data, $product);
        }
        // dd($data);
        return view('user.cart', compact('data'));
    }

    public function deleteCart(Request $request)
    {
        $id = $request->user()->id;
        $cartProduct = cartProduct::where('user_id', $id)->where('product_id', $request->productId)->first();
        $cartProduct->delete();
        return redirect('/homepages/MyCart');
    }

    // public function orderViewSeller(order $order)
    // {
    //     $id = order::where(product::where('id', $order->product_id)->first()->shop_id)->get();
    //     dd($id);
    //     return view('SellerMyOrder');
    // }


    public function deleteOrder(Request $request, string $orderId)
    {
        $order = order::where('id', $orderId)->first();
        $order->delete();
        return redirect('/homepages/MyOrder');
    }
}
