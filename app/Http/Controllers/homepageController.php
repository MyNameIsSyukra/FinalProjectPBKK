<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = $data->get();
        // dd($data);
        if (Auth::user() != Null) {
            return view('homepages', compact('data'));
        } else
            return view('homepage', compact('data'));
    }
}
