<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class homepageController extends Controller
{
    public function showAll()
    {
        $data = product::all();
        // for($i = 0;$i<10;$i++){
        //     if(Cache::has)
        // }
        // dd($data);
        return view('homepage', compact('data'));
    }
}
