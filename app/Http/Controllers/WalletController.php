<?php

namespace App\Http\Controllers;

use App\Events\TopupRequest;
use App\Http\Requests\ConfirmTopupRequest;
use App\Jobs\ProcessTopup;
use Faker\Extension\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Redirect;
use Str;

class WalletController extends Controller
{
    //
    public function requestTopup(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;
        // $userId=4;
        $amount = $request->amount;
        $token = Str::random(20);
        // Log::debug(`test`);
        // Log::info(`Topup amount :{$amount}\nToken :{$token}`);
        TopupRequest::dispatch($userId,$amount,$token);
        // Log::info(`Topup amount :{$amount}\nToken :{$token}`);

        return Redirect::to("/");
    }

    public function confirmTopup(ConfirmTopupRequest $request):JsonResponse{
        $token = $request->token;
        $message= "";
        $status= 200;
        // Cache::get(`topup-request-{$token}`);
        if (Cache::has("topup-request-{$token}")){
            ProcessTopup::dispatchSync($token);
            $message = "Processed";
            // Log::info("in wallet controller, topup dispatched");
        }
        else{
            $message = "Token not found";
            $status =404;
        }
        return response()->json(
            ["message"=>$message],
            $status,
            ['Content-type','application/json']
        );
        
    }
}
