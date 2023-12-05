<?php

namespace App\Http\Controllers;

use App\Events\TopupRequest;
use Faker\Extension\Helper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use Str;

class WalletController extends Controller
{
    //
    public function requestTopup(Request $request): RedirectResponse
    {
        // dd("test");
        $userId=1;
        // $userId = $request->user()->id;
        $amount = $request->amount;
        $token = Str::random(20);
        TopupRequest::dispatch($userId,$amount,$token);
        // $userId = $request->user()->id;
        // $amount = $request->amount;
        // $token = Str::random(20);
        // Cache::put(`topup-request-{$token}`,json_encode([
        //     'userId' => $userId,
        //     "amount" => $amount
        // ]));
        

        return Redirect::to("/");
    }
}
